<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{ url('assets/img/logo-icon.png') }}" type="image/x-icon">
  <title>Internal Server Error</title>
  <meta name="theme-color" content="#2d374b">
  <link rel="manifest" href="manifest.json">
  <meta property="og:site_name" content="Zaad_Retail" />
  <meta property="og:title" content="Zaad_Retail" />

  <!-- Site Fav Icon -->
  <link rel="shortcut icon" href="{{ url('assets/img/favicon.png') }}" />

  <script src="{{ url('register-service-worker.js') }}"></script>
  <link href="{{ url('assets/lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('assets/lib/typicons.font/typicons.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('assets/css/azia.css') }}">
  <style>
    body {
      overflow: hidden !important;
    }

    #webcoderskull {
      position: absolute;
      left: 0;
      padding: 0 20px;
      width: 100%;
      text-align: center;
      overflow: hidden !important;
    }

    canvas {
      height: 100vh;
      background-color: #fff;
    }

    #webcoderskull h1 {
      letter-spacing: 5px;
      font-size: 5rem;
      font-family: 'Roboto', sans-serif;
      text-transform: uppercase;
      font-weight: bold;
    }

    .az-signin-wrapper {
      position: fixed;
      left: 0;
      right: 0;
      bottom: 0;
      top: 0;
    }

    .az-card-signin {
      backdrop-filter: blur(1px);
      background-color: rgba(255, 255, 255, .25);
      width: 600px;
    }
  </style>
</head>

<body class="az-body">
  <div id="particles">
    <div id="webcoderskull">
    </div>
  </div>
  <div class="az-signin-wrapper">
    <div class="az-card-signin rounded-10 shadow-lg border-0 py-5 px-5">
      <div class="az-signin-header">
        {{-- <div class="d-flex justify-content-center mb-2">
          <img src="{{ url('assets/img/zaadDocs.png') }}" class="d-none d-md-block">
          <img src="{{ url('assets/img/zaadDocs-m.png') }}" class="d-block d-md-none" style="width: 130px;">
        </div> --}}
        <h2 class="text-dark mb-4 text-center">Oops! Something went wrong</h2>
        <p class="text-dark text-center">We're experiencing technical difficulties. Please try again later.</p>
        <form action="{{ url('/') }}" class="text-center">
          <button class="btn btn-dark tx-uppercase rounded-10 px-5">Back</button>
        </form>
      </div>
    </div>
  </div>
  <script src="{{ url('assets/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('assets/lib/ionicons/ionicons.js') }}"></script>
  <script src="{{ url('assets/js/azia.js') }}"></script>
</body>

</html>
