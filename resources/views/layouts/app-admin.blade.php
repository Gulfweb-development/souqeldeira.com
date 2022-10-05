<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{ $meta_title ?? 'default meta_title' }}</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/line-awesome.min.css') }}">
    @if (app()->isLocale('ar'))
        <!-- Bootstrap 4 RTL -->
        <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.2.1/css/bootstrap.min.css">
        <!-- Custom style for RTL -->
        <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
        {{-- Fix Admin  Lte RTL --}}
        <link rel="stylesheet" href="{{ asset('css/fix-admin-lte-rtl.css') }}">
    @else
        {{-- Fix Admin  Lte LTR --}}
        <link rel="stylesheet" href="{{ asset('css/fix-admin-lte-ltr.css') }}">
    @endif
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @livewireStyles
    @stack('css')
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        @livewire('admin.components.header')
        @livewire('admin.components.sidebar')


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">

                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $title ?? 'default title' }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                {{ $breadcrumb ?? 'default breadcrumb' }}
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    {{ $slot }}
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    @livewireScripts
    @stack('js')
    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2@10.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        // TOASTER START
        var message;
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
        // SHOW IF SESSION WITH REDIRECT
        @if (session()->has('success'))
            message = "{{ session()->get('success') }}";
            toastr.success(message)
        @endif
        // SHOW IF USED DISPATCH BROWSER EVENT
        window.addEventListener('success', event => {
            toastr.success(event.detail.message)
        })
        // TOASTER END

        // SWEAT ALERT START
        function deleteConfirmation(id) {
            Swal.fire({
                title: "{!! __('app.confirm_title') !!}",
                text: "{!! __('app.confirm_message') !!}",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonText: "{!! __('app.cancle') !!}",
                confirmButtonColor: '#007bff',
                cancelButtonColor: '#d33',
                confirmButtonText: "{!! __('app.delete') !!}"
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete', id);
                }
            })
        }

$(document).ready(function(e){
      // VIDEO MODAL START
                // Gets the video src from the data-src on each button
                var $videoSrc;
                $('.video-btn').click(function() {
                    $videoSrc = $(this).data("src");
                });
                console.log($videoSrc);
                // when the modal is opened autoplay it
                $('#myModal').on('shown.bs.modal', function(e) {
                    // set the video src to autoplay and not to show related video. Youtube related video is like a box of chocolates... you never know what you're gonna get
                    $("#video").attr('src', $videoSrc + "?autoplay=1&amp;modestbranding=1&amp;showinfo=0");
                })
                // stop playing the youtube video when I close the modal
                $('#myModal').on('hide.bs.modal', function(e) {
                    // a poor man's stop video
                    $("#video").attr('src', $videoSrc);
                });
                // VIDEO MODAL END
});

        // SWEAT ALERT END
    </script>
</body>

</html>
