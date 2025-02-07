<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>:: Welcome to e-Allotment of Rental Housing Estate | e-Allotment of Rental Housing Estate ::</title>
    <link rel="stylesheet" href="{{ asset('/bootstrap-5.3.3/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/theme/style.css') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Freeman&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
</head>

<body>

    <section class="slider">
        <div class="overlay-1"></div>
        <div class="overlay-2"></div>
        <a href="{{ route('login.create') }}" class="admin-login position-absolute end-0 mx-4 mt-5">Admin
            Login</a>
        <div class="p-5 text-center position-absolute start-0 end-0">
            <div class="container">
                <a href="{{ url('/') }}">
                    <div class="logo"><img src="{{ asset('/theme/images/wb-logo.png') }}" class="img-fluid" /></div>
                    <div class="logo-text">
                        <h1 class="text-white">e-Allotment of Rental Housing Estate</h1>
                        <h4 class="text-white">Housing Department | Government of West Bengal</h4>
                    </div>
                </a>
                <div class="d-flex justify-content-center h-100 end-0">
                    <form method="post" action="{{ route('login.applicantLogin') }}" onsubmit="return validateForm()">
                        @csrf
                        @method('post')
                        <div class="search">
                            <input class="search_input" type="text" name="hrmsId" id="hrmsId"
                                placeholder="Enter HRMS Id" value="{{ old('hrmsId') }}">
                            <button type="submit" class="search_icon border-0">Go</button>
                        </div>
                        <div class="mt-3" id="error_div">
                            <span id="error_hrmsId" class="bg-white text-danger px-3 py-2 mt-3"
                                style="display: none"></span>
                            @error('hrmsId')
                                <span class="bg-white text-danger px-3 py-2 mt-3">{{ $message }}</span>
                            @enderror
                            @if ($errors->has('user_not_found'))
                                <span
                                    class="bg-white text-danger px-3 py-2 mt-3">{{ $errors->first('user_not_found') }}</span>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="position-fixed start-0 end-0 bottom-0 bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center p-3 my-3">
                    <div class="col-md-2 d-flex align-items-center">
                        <a href="#" class="mb-3 me-2 mb-md-0 text-decoration-none lh-1">
                            <img src="{{ asset('/theme/images/nic_logo.png') }}" class="img-fluid" alt="NIC logo"
                                loading="lazy">
                        </a>

                    </div>

                    <div class="col-md-10 justify-content-end list-unstyled d-flex">
                        <span class="mb-3 mb-md-0 text-light">
                            <small>All contents of the this site are owned and maintained by Department of West Bengal.
                                National Informatics Centre (NIC), will not be responsible for any loss to any person
                                caused by inaccuracy in the information available on this Website.</small>
                        </span>
                    </div>
                </div>
                <p class="text-center text-body-secondary"> Copyright © All Rights Reserved</p>
            </div>
        </div>


        <footer class="text-center p-3">
            <div class="container-lg">
                <div class="row">
                    <div class="col-md-6 text-start">
                        <p class="copyright">Copyright &copy; All Rights Reserved</p>
                    </div>
                    <div class="col-md-6 text-end">
                        <p>
                            <a href="./contact.html">Contact</a> &nbsp;|&nbsp;
                            <a href="#">Site Map</a> &nbsp;|&nbsp;
                            <a href="#">Privacy Policy</a> &nbsp;|&nbsp;
                            <a href="#">Disclaimer</a>
                        </p>
                    </div>
                </div>
        </footer>
    </section>


    <div class="position-absolute collapse accessibility-panel" id="navbarToggleExternalContent">
        <div class="p-2">
            <ul class="font-panel">
                <li>
                    <a href="#">
                        <span><img src="{{ asset('/theme/images/text-size.png') }}"></span>
                        <strong>Bigger Text</strong>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><img src="{{ asset('/theme/images/text-size.png') }}"></span>
                        <strong>Small Text</strong>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><img src="{{ asset('/theme/images/brightness-and-contrast.png') }}"></span>
                        <strong>Light-Dark</strong>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span><img src="{{ asset('/theme/images/reset.png') }}"></span>
                        <strong>Reset Settings</strong>
                    </a>
                </li>
            </ul>

        </div>
    </div>
    <nav class="navbar accessibility position-absolute">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent"
            aria-expanded="false" aria-label="Toggle navigation">
            <img src="{{ asset('/theme/images/accessability.png') }}" class="img-fluid" />
        </button>
    </nav>
    <script src="{{ asset('/bootstrap-5.3.3/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>

<script>
    function validateForm() {
        const hrmsId = document.getElementById("hrmsId").value;
        const format = /^\d{10}$/;
        if (!hrmsId) {
            document.getElementById('error_hrmsId').style.display = 'block';
            document.getElementById('error_hrmsId').innerHTML = "Please enter your HRMS ID";
            return false;
        } else if (format.test(hrmsId) === false) {
            document.getElementById('error_hrmsId').style.display = 'block';
            document.getElementById('error_hrmsId').innerHTML = "Please enter valid HRMS ID";
            return false;
        } else {
            document.getElementById('error_hrmsId').style.display = 'none';
            return true;
        }
    }
</script>
