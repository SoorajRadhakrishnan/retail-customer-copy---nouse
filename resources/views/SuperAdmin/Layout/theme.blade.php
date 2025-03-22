<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="POS Web Application for Retail ">
    <meta name="author" content="zaadPlatform">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - ZaadPlatform</title>
    <link rel="shortcut icon" href="{{ url('assets/img/favicon.webp') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- <link href="assets/lib/fontawesome-free/css/all.min.css" rel="stylesheet"> -->
    <link href="{{ url('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/typicons.font/typicons.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.4.0/css/responsive.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel="stylesheet">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.4.0/css/fixedHeader.dataTables.min.css"> -->
    <link rel="stylesheet" href="{{ url('assets/css/azia.css?v=') }}">
    <link href="{{ url('assets/lib/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ url('assets/lib/select2/dist/css/select2-bootstrap-5-theme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/css/style.css?v=') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="{{ url('assets/lib/jquery/jquery.min.js') }}"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <script src="{{ url('assets/lib/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/swipe.js') }}"></script>
    @section('style')

    @show
</head>

<body id="body">

    @section('content')

    @show

    <div class="modal fade" id="dynamicPopup-sm" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-sm"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-md" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-lg" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-lg"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-xl" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-xl"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-video" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered bg-transparent border-0">
            <div class="modal-content rounded-10 popupContent-video bg-dark border-0"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-md2" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md2"> </div>
        </div>
    </div>
    <div class="modal fade" id="dynamicPopup-md3" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content rounded-10 popupContent-md3"> </div>
        </div>
    </div>

    <div id="if"></div>

    {{-- notification --}}
    <div class="col-notify">
        <div class="col-notify-in">
            <p id="notifyTxt"></p>
        </div>
    </div>
    {{-- notification --}}

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"></script>
    <script src="{{ url('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/lib/dataTables.bootstrap4/jquery.dataTables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('assets/lib/notify/notify.min.js') }}"></script>
    <script src="{{ url('assets/js/azia.min.js') }}"></script>
    <!-- <script src="assets/js/main.min.js"></script> -->
    {{-- <script>
        function showProcessing(id, txt) {
            var image = '{{ url("assets/img/loading.gif") }}';
            $("#" + id).append(
                '<table class="col-xs-12 processing"><tr><td><img src="'+image+'"><p class="text-center">' +
                    txt +
                    "</p></td></tr></table>"   );
        }
    </script> --}}
    <script src="{{ url('assets/js/main.js?v=749508564') }}"></script>
    @if (Session::has('message'))
        <script>
            notifyme2("{{ Session::get('message') }}");
        </script>
    @endif

    @section('script')

    @show

</body>

</html>
