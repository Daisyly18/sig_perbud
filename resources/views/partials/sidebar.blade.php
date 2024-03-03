<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">
            <img src="{{ asset('/img/logo_pohuwato.png') }}" alt="logo" width="45" height="45">
            SIGPERBUD</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm -mt-20">
        <a href="index.html">
            <img src="{{ asset('/img/logo_pohuwato.png') }}" alt="logo" width="50" height="50" style="margin-top: 10px">
        </a>
      </div>
      <ul class="sidebar-menu">
          <li class="nav-item {{Request::is('dashboard')?'active':'';}}">
            <a href="{{ url('dashboard') }}" class="nav-link" style="line-height: 1;">
              <i class="fas fa-table"></i><span>Dashboard</span>
            </a>
          </li>
          <li class="nav-item {{Request::is('aquaculture*')?'active':'';}}">
            <a href="{{ url('aquaculture') }}" class="nav-link">
              <i class="fas fa-fish"></i> <span>Perikanan Budi daya</span>
            </a>
          </li>
          <li class="nav-item {{Request::is('pondsProgress*')?'active':'';}}">
            <a href="{{ url('pondsProgress') }}" class="nav-link">
              <i class="fas fa-water"></i> <span>Perkembangan Tambak</span>
            </a>
          </li>
          <li class="nav-item {{Request::is('user*')?'active':'';}}">
            <a href="{{url('user')}}" class="nav-link"><i class="fas fa-users">
              </i> <span>Data Users</span>
            </a>
          </li>
          <li class="nav-item {{Request::is('mapview*')?'active':'';}}">
            <a href="{{url('mapview')}}" class="nav-link"><i class="fa-solid fa-map">
              </i> <span>Map</span>
            </a>
          </li>
      </ul> 
    </aside>
  </div>
