<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GESImoveis</title>

    <!-- Stylesheets -->

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

        </div>
        <!-- Footer -->
        @include('admin.body.footer')
        <!-- End Footer -->
    </div>
</body>
</html>
