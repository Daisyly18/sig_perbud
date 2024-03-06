<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Peta &mdash; SIGPERBUD</title>

  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"><!-- Tambahkan referensi ke Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Tambahkan referensi ke Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  

  <!-- Bootstrap JavaScript -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  
  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" >


  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">


  <!--Leaflet-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
  {{-- <link rel="stylesheet" href="leaflet-search-master\leaflet-search-master\dist\leaflet-search.src.css"> --}}
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet-ajax/2.0.0/leaflet.ajax.min.js"></script>
  <link rel="stylesheet" href="https://unpkg.com/leaflet.polylinemeasure/Leaflet.PolylineMeasure.css" />
  <script src="https://unpkg.com/leaflet.polylinemeasure/Leaflet.PolylineMeasure.js"></script>
  <script src="https://unpkg.com/leaflet.defaultextent/dist/leaflet-defaultextent.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/leaflet.control.layers@3.4.2/dist/leaflet.control.layers.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet-easybutton/src/easy-button.css">
  <script src="https://unpkg.com/leaflet-easybutton/src/easy-button.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css">
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!-- Leaflet Measure Control CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet-measure/dist/leaflet-measure.css" />

<!-- Leaflet Measure Control JavaScript -->
<script src="https://unpkg.com/leaflet-measure/dist/leaflet-measure.js"></script>


  <!--Leaflet-Geodecor-->
  <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
  
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">

</head>
<body class="index-page" data-bs-spy="scroll" data-bs-target="#navmenu">
  <nav class="d-flex justify-content-between align-items-center text-center px-3 py-1 navbar-light bg-primary">
    <div class="nav-logo">
      <img src="{{ asset('/img/logo_pohuwato.png') }}" alt="Logo" width="65px" />
    </div>
    <div class="nav-header flex-grow-1">
      <h4 style="color: #FFFFFF">Sistem Informasi Geografis</h4>
      <h4 style="color: #FFFFFF">Persebaran Perikanan Budi Daya Kabupaten Pohuwato </h4>
    </div>
    <div class="header-container">
      <button class="btn btn-primary" type="button" id="dropdownMenuButton1">
        <i class="fa-solid fa-bars"></i> <!-- Ganti dengan ikon bars -->
      </button>
      <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
        <li><a class="dropdown-item" href="{{route('home')}}">Home</a></li>
        <li><a class="dropdown-item" href="{{route('login')}}">Login</a></li>        
      </ul>
    </div>
  </nav>
  <div id="map" style="height: 560px">
    @include('maps.maps')
  </div>

  <footer class="main-footer">
    <div class="footer-left">
      Copyright &copy; 2024 <div class="bullet"></div> Design By <a href="#">Dwi Sukma Silvina Putri</a>
    </div>
    <div class="footer-right">
      2.3.0
    </div>
  </footer>
</body>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    var toggleButton = document.getElementById('dropdownMenuButton1');
    var dropdownMenu = document.querySelector('.dropdown-menu');

    toggleButton.addEventListener('click', function () {
      if (dropdownMenu.style.display === 'block') {
        dropdownMenu.style.display = 'none';
      } else {
        dropdownMenu.style.display = 'block';
        dropdownMenu.style.top = toggleButton.offsetHeight + 'px'; // Set posisi top sesuai dengan tinggi tombol
      }
    });
  });
</script>





