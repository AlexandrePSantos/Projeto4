<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESImoveis</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-select/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-datepicker/datepicker3.css') }}">
    <link rel="stylesheet" href="{{ asset('js/vendors/bootstrap-toggle/bootstrap-toggle.min.css') }}">
    <!-- End Stylesheets -->

    <link rel="shortcut icon" href="{{ asset('uploads/favicon.png') }}">

</head>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <!-- Header -->
            @include('admin.body.header')
            <!-- End Header -->

            <!-- Content -->
            @yield('admin')
            <!-- End Content -->

            <!-- Footer -->
            <footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between px-4 py-3 border-top small">
                <div class="container">
                    <ul class="list-inline ">
                        <li>
                            <a href="https://www.ftkode.com" target="_blank">FTKode</a>
                        </li>
                    </ul>
                </div>
            </footer>
            <!-- End Footer -->
        </div>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- End JavaScripts -->
</body>
</html>
