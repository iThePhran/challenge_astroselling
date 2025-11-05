@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(Auth::user()->hasRole('Admin'))
                        <div class="row text-center mb-4">
                            <div class="col-md-3">
                                <div class="card shadow-sm p-3">
                                    <h5>Usuarios</h5>
                                    <h3>{{ $totalUsers }}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card shadow-sm p-3">
                                    <h5>Jobs procesados</h5>
                                    <h3>{{ $processedJobs }}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card shadow-sm p-3">
                                    <h5>Alertas activas</h5>
                                    <h3>{{ $alertCount }}</h3>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card shadow-sm p-3">
                                    <h5>Última sincronización</h5>
                                    <h3>{{ $lastSync }}</h3>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="alert alert-info" role="alert">
                        Bienvenido, {{ Auth::user()->name }}. Su cuenta está en revisión por un administrador.
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
@endsection