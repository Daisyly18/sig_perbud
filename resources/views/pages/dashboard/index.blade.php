@extends('layouts.main')
@section('title', 'Dashboard')
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
            <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Total Penyuluh</h4>
                </div>
                <div class="card-body">
                10
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
            <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Total Pembudidaya</h4>
                </div>
                <div class="card-body">
                42
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
            <div class="card-icon bg-warning">
                <i class="far fa-file"></i>
            </div>
            <div class="card-wrap">
                <div class="card-header">
                <h4>Total Perikanan Budidaya Aktif</h4>
                </div>
                <div class="card-body">
                1,201
                </div>
            </div>
            </div>
        </div>          
    </div>   
    <div class="row">
        <div class="col-lg-6 col-md-6 col-12">
          <div class="card">
            <div class="card-header">
              <h4>Perikanan Budidaya</h4>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">2,100</div>
                <div class="font-weight-bold mb-1">Google</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">1,880</div>
                <div class="font-weight-bold mb-1">Facebook</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">1,521</div>
                <div class="font-weight-bold mb-1">Bing</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">884</div>
                <div class="font-weight-bold mb-1">Yahoo</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" data-width="36%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">473</div>
                <div class="font-weight-bold mb-1">Kodinger</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" data-width="28%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">418</div>
                <div class="font-weight-bold mb-1">Multinity</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" data-width="20%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>       
        </div> 
        <div class="col-lg-6 col-md-6 col-12">
            <div class="card">
              <div class="card-header">
                <h4>Tahap Perikanan Budidaya</h4>
              </div>
              <div class="card-body">
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted">2,100</div>
                  <div class="font-weight-bold mb-1">Tahap Awal</div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted">1,880</div>
                  <div class="font-weight-bold mb-1">Tahap Pembesaran</div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="67%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="mb-4">
                  <div class="text-small float-right font-weight-bold text-muted">1,521</div>
                  <div class="font-weight-bold mb-1">Tahap Panen</div>
                  <div class="progress" data-height="3">
                    <div class="progress-bar" role="progressbar" data-width="58%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
  
              </div>
            </div>       
          </div>        
    </div>       
    <div class="row">
             
    </div>       
    
</div>

     
@endsection