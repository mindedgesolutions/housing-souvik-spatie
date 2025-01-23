<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserLaravel;
use Illuminate\Support\Facades\DB;

class MigrateController extends Controller
{
    public function migrateUsers($lastUserId = 1)
    {
        try {
            DB::beginTransaction();

            $users = User::whereNotNull('name')
                ->where('name', '!=', '')
                ->where('uid', '>', $lastUserId)
                ->orderBy('uid')
                ->limit(10)
                ->get();

            foreach ($users as $user) {
                $email = $user->mail ?? strtolower($user->name) . '@gmail.com';

                $checkExists = UserLaravel::where('email', $email)->exists();

                if (!empty($checkExists)) {
                    $newUserId = DB::table('user_laravels')->insertGetId([
                        'name' => $user->name,
                        'email' => $email,
                        'password' => $user->pass,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    DB::table('user_map')->insert([
                        'old_id' => $user->uid,
                        'new_id' => $newUserId,
                    ]);
                }
            }
            $newLastUserId = $users->last()->uid;
            $this->migrateUsers($newLastUserId);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
        }
    }
}
