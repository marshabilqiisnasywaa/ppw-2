<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">
</head>
<body>
    <div class="container mt-4">
        @yield('content')
    </div>

    <!-- jQuery -->
    <script src="{{ asset('js/jquery.js') }}"></script>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Datepicker -->
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript">
        $('.date').datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true
        });
    </script>

    <!-- Section for Additional Scripts -->
    @yield('scripts')
</body>
</html>