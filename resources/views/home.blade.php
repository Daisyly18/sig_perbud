<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Home &mdash; SIGPERBUD</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/main.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>
<body>
    <div id="app">
      <section id="hero" class="hero">
        <img src="{{ asset('/pohuwato/4.jpg') }}" alt="" data-aos="fade-in">
        <img src="{{ asset('/pohuwato/2.jpg') }}" alt="" data-aos="fade-in">
        <img src="{{ asset('/pohuwato/3.jpg') }}" alt="" data-aos="fade-in">
        <img src="{{ asset('/pohuwato/1.jpg') }}" alt="" data-aos="fade-in">
        <div class="absolute-center-left index-2">
          <div class="container">
              <div class="row">
                <div class="col-lg-12">
                  <h1 data-aos="fade-up" data-aos-delay="100">Sistem Informasi Geografis <br>Persebaran Perikanan Budi Daya</h1>
                  <h3 data-aos="fade-up" data-aos-delay="200">Kabupaten Pohuwato</h3>
                </div>
                <div class="col-lg-10">
                  <div class="buttons" data-aos="fade-up" data-aos-delay="300">
                    <a href="{{route('map')}}" class="btn btn-primary m-1">Peta</a>
                    <a href="{{route('login')}}" class="btn btn-info">Login</a>
                  </div>                    
                </div>
              </div>
            </div>                
          </div>
        </div>        
      </section>
    </div>
      

  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    $(document).ready(function() {
    
      var images = $('#hero img');
      var currentIndex = 0;

      function showNextImage() {
        images.removeClass('active');
        currentIndex = (currentIndex + 1) % images.length;
        images.eq(currentIndex).addClass('active');
      }
      // Set interval to change image every 5 seconds (5000 milliseconds)
      setInterval(showNextImage, 5000);

      AOS.init();
    });
  </script>
  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="{{ asset('/js/scripts.js') }}"></script>
  <script src="{{ asset('/js/custom.js') }}"> </script> 
</body>
</html>
