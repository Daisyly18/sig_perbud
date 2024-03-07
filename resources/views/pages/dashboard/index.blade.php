@extends('layouts.main')
@section('title', 'Dashboard')
@section('dashboard', 'active')
@section('content')
<div class="section-body">
    <div class="row">
        <div class="col-lg-6">
          <div class="row">
            <div class="col-3 col-md-6">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Total Penyuluh</h4>
                    </div>
                    <div class="card-body">
                      {{ $penyuluh }}
                    </div>
                </div>
                </div>
            </div>
            <div class="col-3 col-md-6 ">
              <div class="card card-statistic-1">
              <div class="card-icon bg-warning">
                  <i class="fas fa-users"></i>
              </div>
              <div class="card-wrap">
                  <div class="card-header">
                  <h4>Total Pembudidaya</h4>
                  </div>
                  <div class="card-body">
                    {{ $pembudidaya }}
                  </div>
              </div>
              </div>
            </div>
          </div>  
          <div class="row">
            <div class="col-3 col-md-6 ">
              <div class="card card-statistic-1">
              <div class="card-icon bg-success">
                <i class="far fa-bell"></i>
              </div>
              <div class="card-wrap">
                  <div class="card-header">
                  <h4>Lahan Tambak Aktif</h4>
                  </div>
                  <div class="card-body">
                    {{ $statusAktif }}
                  </div>
              </div>
              </div>
            </div>          
            <div class="col-3 col-md-6">
                <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-bell"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                    <h4>Lahan Tambak Tidak Aktif</h4>
                    </div>
                    <div class="card-body">
                      {{ $statusTidakAktif }}
                    </div>
                </div>
                </div>
            </div>
          </div> 
          <div class="row">
            <div class="col-6 col-md-12">
              <div class="card">
                <div class="card-header">
                  <h4>Tahap Perikanan Budidaya</h4>
                </div>
                <div class="card-body">
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{ $stage1 }}</div>
                    <div class="font-weight-bold mb-1">Tahap Awal</div>
                    <div class="progress" data-height="3">
                        <div class="progress-bar" role="progressbar" style="width: {{ $stage1 }}%;" aria-valuenow="{{ $stage1 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>
                
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{ $stage2 }}</div>
                    <div class="font-weight-bold mb-1">Tahap Pembesaran</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" style="width: {{ $stage2 }}%;" aria-valuenow="{{ $stage2 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                  <div class="mb-4">
                    <div class="text-small float-right font-weight-bold text-muted">{{ $stage3 }}</div>
                    <div class="font-weight-bold mb-1">Tahap Panen</div>
                    <div class="progress" data-height="3">
                      <div class="progress-bar" role="progressbar" style="width: {{ $stage3 }}%;" aria-valuenow="{{ $stage3 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
    
                </div>
              </div>
            </div>
          </div>         
        </div>   
        <div class="col-lg-6 col-md-6">
          <div class="card">
            <div class="card-header">
              <h4>Perikanan Budidaya</h4>
            </div>
            <div class="card-body">
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $paguat }}</div>
                <div class="font-weight-bold mb-1">Paguat</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $paguat }}%;" aria-valuenow="{{ $paguat }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $duhiadaa }}</div>
                <div class="font-weight-bold mb-1">Duhiadaa</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $duhiadaa }}%;" aria-valuenow="{{ $duhiadaa }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $lemito }}</div>
                <div class="font-weight-bold mb-1">Lemito</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $lemito }}%;" aria-valuenow="{{ $lemito }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $patilanggio }}</div>
                <div class="font-weight-bold mb-1">Patilanggio</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $patilanggio }}%;" aria-valuenow="{{ $patilanggio }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $popayato }}</div>
                <div class="font-weight-bold mb-1">Popayato</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $popayato }}%;" aria-valuenow="{{ $popayato }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>

              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $popayatoTim }}</div>
                <div class="font-weight-bold mb-1">Popayato Timur</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $popayatoTim }}%;" aria-valuenow="{{ $popayatoTim }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $popayatoBar }}</div>
                <div class="font-weight-bold mb-1">Popayato Barat</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $popayatoBar }}%;" aria-valuenow="{{ $popayatoBar }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $randangan }}</div>
                <div class="font-weight-bold mb-1">Randangan</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $randangan }}%;" aria-valuenow="{{ $randangan }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $wanggarasi }}</div>
                <div class="font-weight-bold mb-1">Wanggarasi</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $wanggarasi }}%;" aria-valuenow="{{ $wanggarasi }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $buntulia }}</div>
                <div class="font-weight-bold mb-1">Buntulia</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $buntulia }}%;" aria-valuenow="{{ $buntulia }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $marisa }}</div>
                <div class="font-weight-bold mb-1">Marisa</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $marisa }}%;" aria-valuenow="{{ $marisa }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $dengilo }}</div>
                <div class="font-weight-bold mb-1">Dengilo</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $dengilo }}%;" aria-valuenow="{{ $dengilo }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
              <div class="mb-4">
                <div class="text-small float-right font-weight-bold text-muted">{{ $taluditi }}</div>
                <div class="font-weight-bold mb-1">Taluditi</div>
                <div class="progress" data-height="3">
                  <div class="progress-bar" role="progressbar" style="width: {{ $taluditi }}%;" aria-valuenow="{{ $taluditi }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              </div>
            </div>
          </div>       
        </div>
    </div>       
</div>

     
@endsection