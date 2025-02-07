<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="favicon-48.ico" type="favicon-48.ico">
    <link rel="icon" href="favicon-32.ico" type="favicon-32.ico">
    <title>Welcome to e-Allotment of Rental Housing Estates. Housing Department, Government of West Bengal</title>
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
    <link href="{{ asset('css/login/bootstrap.min.css') }}" rel="stylesheet">
</head>

<body>
    <section class="admin-login-bg text-center">
        <div class="admin-login-top-bg">
            <div><a href="#" target="_self"><img src="{{ asset('images/login/admin-logo-rhe.png') }}"
                        alt="e-Allotment of Rental Housing Estates" title="e-Allotment of Rental Housing Estates"></a>
            </div>
            <h2 class="mt-4">Admin Sign in to Continue</h2>
        </div>
        <div class="admin-login-white-bg text-start">
            <form action="{{ route('login.store') }}" autocomplete="off" method="post">
                @csrf
                @method('post')
                <div class="mb-3 mt-3">
                    <input type="email" class="form-control input-form-custom" id="email"
                        placeholder="Enter user name" name="email">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control input-form-custom" id="password"
                        placeholder="Enter password" name="password">
                </div>

                <div class="captcha">
                    <input type="hidden" name="captcha_sid" value="">
                    <input type="hidden" name="captcha_token" value="">
                    {{-- <img typeof="foaf:Image"
                        src="/rhewbhousing/rhe-wbhousing-v2/image_captcha?sid=190783&amp;ts=1738836786" width="180"
                        height="60" alt="Image CAPTCHA" title="Image CAPTCHA"> --}}
                    <img src="{{ captcha_src('default') }}" alt="captcha">
                    <div class="form-item form-type-textfield form-item-captcha-response">
                        <label for="edit-captcha-response">What code is in the image? <span class="form-required"
                                title="This field is required.">*</span></label>
                        <input type="text" id="edit-captcha-response" name="captcha_response" value=""
                            size="15" maxlength="128" class="form-text required" autocomplete="off">
                        <div class="description">Enter the characters shown in the image.</div>
                    </div>
                    <div class="reload-captcha-wrapper">
                        <a href="/rhewbhousing/rhe-wbhousing-v2/captcha/refresh/user_login"
                            class="reload-captcha">Generate a new captcha</a>
                    </div>
                </div>

                <div class="clearfix mb-3"></div>
                <div class="d-grid mb-3">
                    <button type="submit" class="admin-login-btn btn-block custom-btn-rounded">Sign in</button>
                </div>
                <div class="clearfix">
                    <div class="float-start"><a href="#" class="admin-signin-link">Sign in with your OTP</a></div>
                    <div class="float-end"><a href="#" class="admin-forgot-link">Forgot Password ?</a></div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>

<script src="{{ asset('jquery/jquery.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<script></script>
