<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AdminLTE 3 | Dashboard</title>

    <!--Bootstrap-->
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css') }}" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            color: #14181f
        }

        .bg-light-blue {
            background-color: #eceff3 !important;
        }

        .nav-bar-blue {
            background-color: #e3e6ed !important;
        }

        .sidebar-blue {
            background-color: #f0f2f6 !important;
        }

        .nav-link-color {
            color: #46546e !important;
        }

        .accent-color {
            color: #8897b4 !important;
        }

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #bcc5d5;
        }
        .table-bg{
            background-color: #eceff3 !important;
        }
        .text-color {
            color: #14181f !important;
        }
        .primary-button {
            background-color: #bcc5d5;
            color: #14181f;
        }

        .secondary-button {
            background-color: #f6f8fa;
            color: #14181f;
            border style: solid;
            border-color: #14181f;
        }
        .table-color{
            background-color: #eceff3
        }

        /* .nav-bar-blue .nav-item .nav-link{
            color: #6c757d !important;
        } */
    </style>
</head>

<!--Dashboard-->

<body class=" hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        {{-- @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            </div>
        @endif --}}
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand nav-bar-blue border-bottom">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar user panel -->
                <div class="user-panel pb-1 d-flex">
                    <div class="info position-relative">
                        <div>
                            <div class="card bg-transparent shadow-none border-0">
                                <div class="card-body py-0 d-flex align-items-center">
                                    {{-- <img src="{{ asset('dist/img/user.png') }}" class="my-3 mr-3 img-fluid border-0 shadow-none bg-transparent" alt="user-image"> --}}
                                    <div>
                                        <p class="accent-color d-block p-0 m-0 fw-normal text-uppercase text-center">{{ Auth::user()->name }}</p>
                                        <p class="accent-color d-block p-0 m-0 text-start fw-light text-center">
                                            @if (Auth::check())
                                                @if (Auth::user()->usertype == '0')
                                                    Student
                                                @elseif (Auth::user()->usertype == '1')
                                                    Teacher
                                                @elseif (Auth::user()->usertype == '2')
                                                    Admin
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-blue border-end">
            <!-- Brand Logo -->
            <div class="text-center px-3 pt-5 m-0">
                <a href="{{ route('dashboard') }}" class="text-decoration-none">
                    <p class="text-uppercase accent-color fw-semibold">Lorem University Portal</p>
                </a>
            </div>


            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->


                        @yield('sidebar_menu')

                        <li class="nav-item  ">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); logout();"
                                class="nav-link">
                                <i class="nav-icon fas fa-solid fa-user" style="color: #8897b4;"></i>

                                <p class="accent-color fw-semibold">
                                    LOG OUT
                                </p>
                            </a>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper bg-light-blue" style="background-color: #eceff3;">
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                @yield('dashboard_stuff')
            </div>
            <!-- /.content -->
        </div>

    </div>
    <!-- ./wrapper -->

    <!-- Modal -->
    <div class="modal fade" id="Profile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        ...
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>


    {{-- Log Out --}}
    <script>
        function logout() {
            fetch('{{ route('logout') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        window.location.href = '/';
                    }
                })
                .catch(error => {
                    console.error('Logout failed:', error);
                });
        }
    </script>

    {{-- Active Nav Link --}}
    <script>
        var currentUrl = window.location.href;
        var links = document.querySelectorAll('.nav-link');

        for (var i = 0; i < links.length; i++) {
            var link = links[i];
            var href = link.getAttribute('href');

            // Use a more specific condition to check if the current URL matches the link's href
            if (currentUrl.endsWith(href) || currentUrl === href) {
                link.classList.add('active');
            }
        }
    </script>



    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 5.3 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

    <!--Font Awesome-->
    <script src="https://kit.fontawesome.com/2c5b5e3390.js" crossorigin="anonymous"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
    <!-- jQuery -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../plugins/jszip/jszip.min.js"></script>
    <script src="../../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- Page specific script -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add a change event listener to the select-unit select element
            $('#select-unit').change(function() {
                // Send an AJAX request
                var selectedUnit = $(this).val();
                $.ajax({
                    url: "{{ route('grades.fetch', ['unitId' => ':unitId']) }}".replace(':unitId',
                        selectedUnit),
                    type: 'GET',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(data) {
                        console.log(data.length);
                        // Remove existing options from the select-student select element
                        $('#select-student option:not(:first)').remove();

                        // Create new options based on the data and append them to the select-student select element
                        $.each(data, function(index, value) {
                            $('#select-student').append('<option name="ADM" value="' +
                                value.ADM +
                                '">' + value.name + '</option>');
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching options: ' + error);
                    }
                });
            });
        });
    </script>
</body>

</html>
