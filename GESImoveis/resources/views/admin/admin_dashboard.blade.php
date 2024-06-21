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
    <!-- Exibir alertas -->
    @if(session('success'))
    <div class="alert success show">
        {{ session('success') }}
        <a href="#" class="alert-close">&times;</a>
    </div>
    @endif

    @if(session('error'))
    <div class="alert error show">
        {{ session('error') }}
        <a href="#" class="alert-close">&times;</a>
    </div>
    @endif

    @if(session('warning'))
    <div class="alert warning show">
        {{ session('warning') }}
        <a href="#" class="alert-close">&times;</a>
    </div>
    @endif

    @if(session('info'))
    <div class="alert info show">
        {{ session('info') }}
        <a href="#" class="alert-close">&times;</a>
    </div>
    @endif
</body>
</html>
