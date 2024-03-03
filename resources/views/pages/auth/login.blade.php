<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Login &mdash; SIGPERBUD</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>

<body>
@if(Auth::check())
  <script>window.location = "{{ route('dashboard.index') }}";</script>
@endif
  <div id="app">
    <section class="section">      
      <div class="d-flex flex-wrap align-items-stretch">
        <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
          <div class="p-4 m-5">            
            <div style="display: flex; align-items: center;margin-bottom: 50px;">
              <img src="{{ asset('/img/logo_pohuwato.png') }}" alt="logo" width="80">
              <h2 style="margin-left: 10px;">SIGPERBUD</h2>
            </div>      
            @if ($errors->any())
            <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $item)
                    <li>{{$item}}</li>
                @endforeach
              </ul>
            </div>
                
            @endif                
            <form method="POST" action="{{ route('auth.login') }}" class="needs-validation">
              @csrf
              <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" class="form-control @error('username') is-invalid                     
                @enderror" name="username" tabindex="1" required autofocus value="{{ old('username') }}">
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    Please fill in your Username
                </div>
              </div>

              <div class="form-group">
                <div class="d-block">
                    <label for="password" class="control-label">Password</label> 
                    <div class="float-right">
                      <a href="#" class="text-small">
                          Forgot Password?
                      </a>
                  </div>                   
                </div>
                <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="invalid-feedback">
                    please fill in your password
                </div>
            </div>       
              <div class="form-group text-right">          
                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                  Login
                </button>
              </div>
            </form>

            <div class="text-center mt-5 text-small">
              Copyright &copy; Dwi Sukma Silvina Putri
              <div class="mt-2">
                <a href="#">Privacy Policy</a>
                <div class="bullet"></div>
                <a href="#">Terms of Service</a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="{{ asset('/img/foto.jpg') }}">
          <div class="absolute-bottom-left index-2">
            <div class="text-light p-5 pb-2">              
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="../assets/js/stisla.js"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{ asset('/js/scripts.js') }}"></script>
  <script src="{{ asset('/js/custom.js') }}"> </script> 

  <!-- Page Specific JS File -->
</body>
</html>
