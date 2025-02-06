@extends('layouts.dashboard-master')

@section('page-header', 'Dashboard')

@section('title', 'Dashboard | ' . config('app.name'))

@section('dashboard-body')
    <div class="region region-content">
        <div id="block-system-main" class="block block-system">
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="counter-box p-3 rounded mb-3 position-relative shadow-sm row">
                            <div class="col-md-9">
                                <h4 class="title-lg">Welcome to e-Allotment of Rental Housing Estate</h4><br>
                                <h6>Designation: {{ $user->housingApplicantOfficialDetails->applicant_designation }}</h6>
                                <h6>Mobile Number: {{ $user->housingApplicantOfficialDetails->mobile_no }}</h6>
                                <h6>Email: {{ $user->email }}</h6>
                            </div>
                            <div class="col-md-3"><img
                                    src="http://10.173.42.87:8080/rhewbhousing/rhe-wbhousing-v2/sites/all/themes/housingtheme/images/dashboard-user.jpeg"
                                    style="border-radius: 50%;" /></div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <h4 class="mt-4">Application List</h4>
                    <div class="col-md-9">
                        <div class="table-responsive rounded counter-box shadow-sm p-3">
                            <table class="table table-list table-striped table-hover table-bordered">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Name</th>
                                        <th>Application Number</th>
                                        <th>Date of Application</th>
                                        <th>Status of Application</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><b>TEST</b></td>
                                        <td>EO-02012025-3565</td>
                                        <td>N/A</td>
                                        <td>Existing Occupant</td>
                                    </tr>

                                </tbody>
                            </table>
                            <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-end pagination-sm">
                                    <li class="page-item disabled">
                                        <a class="page-link">Previous</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">Next</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card h-100 notification-box">
                            <div class="card-body">
                                <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                                    <div class="carousel-indicators">
                                        <button type="button" data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="0" class="active" aria-current="true"
                                            aria-label="Slide 1"></button>
                                        <button type="button" data-bs-target="#carouselExampleCaptions"
                                            data-bs-slide-to="1" aria-label="Slide 2"></button>
                                    </div>
                                    <div class="carousel-inner text-center">

                                        <div class="carousel-item active p-3">
                                            <img src="http://10.173.42.87:8080/rhewbhousing/rhe-wbhousing-v2/sites/all/themes/housingtheme/images/notification.png"
                                                class="w-75" />
                                            <p style="color:red; font-family: Arial, sans-serif; font-size: 16px;">No Latest
                                                Notifications</p>


                                        </div>



                                        <div class="carousel-item p-3">
                                            <img src="http://10.173.42.87:8080/rhewbhousing/rhe-wbhousing-v2/sites/all/themes/housingtheme/images/notification.png"
                                                class="w-75" />
                                            <p style="color:red; font-family: Arial, sans-serif; font-size: 16px;">No Latest
                                                Notifications</p>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
