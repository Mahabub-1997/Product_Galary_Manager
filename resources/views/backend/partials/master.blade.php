<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>TradeMate</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('/')}}backend/AdminAssets/backend/dist/js/toastr/toastr.min.css ">
    <link rel="stylesheet" href=" {{ asset('/')}}backend/AdminAssets/backend/plugins/icofont/icofont.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}backend/AdminAssets/backend/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('/')}}backend/AdminAssets/backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}backend/AdminAssets/backend/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}backend/AdminAssets/backend/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="{{ asset('/')}}backend/AdminAssets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="{{  asset('/')}}backend/AdminAssets/css/new.css">
    <style>
        .imgWrap { display: flex; justify-content: center;}
        .imgcontain { position: relative; width: max-content}
        .imgcontain img { display: block; }
        .imgcontain .fa-trash { position: absolute; top:10px; right:10px; }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{  asset('/')}}backend/AdminAssets/backend/dist/css/alt/bootstrap.min.css" />
    <link rel="stylesheet" href="{{  asset('/')}}backend/AdminAssets/backend/dist/css/alt/bootstrap-select.min.css" />
    <script src="{{ asset('backend/AdminAssets/js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper" id="app">
    @include('backend.partials.navbar')
    @include('backend.partials.sidebar')
    @yield('content')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
    </aside>

    <footer class="main-footer">
        <strong>Copyright &copy; 2025 <a href="">Product Gallery</a>.</strong>
        All rights reserved At ProductGallery.
    </footer>
</div>

<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/dist/js/adminlte.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/chart.js/Chart.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/select2/js/select2.full.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/dist/js/pages/dashboard2.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/dist/js/toastr/toastr.min.js "></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/dist/js/custom.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/dist/js/sweetalert2.min.js"></script>
</body>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="{{ asset('/')}}backend/AdminAssets/backend/dist/js/bootstrap-select.min.js"></script>

<script src="{{ asset('backend/AdminAssets/js/app.js') }}"></script>

<script>
    $(document).ready(function() {
        // $('.select2').select2();
        $('.search_select_box select').selectpicker();
    });
</script>
<script>
    function deleteStudent(id)
    {
        event.preventDefault();
        var check = confirm('Are you sure want to update this!');
        if(check)
        {
            document.getElementById('deleteStudentForm'+id).submit();
        }
    }
</script>
<script>
    $(document).ready(function() {
        $('#categorySearch').keyup(function() {
            var searchText = $(this).val().toLowerCase();
            $('#myTable tbody tr').each(function() {
                var rowText = $(this).text().toLowerCase();
                if (rowText.indexOf(searchText) === -1) {
                    $(this).hide();
                } else {
                    $(this).show();
                }
            });
        });
    });
</script>
</html>
