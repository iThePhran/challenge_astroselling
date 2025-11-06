@extends('layouts.app')

@section('content')
<div class="card">
                <h5 class="card-header">User list</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead class="table-light">
                      <tr>
                      <th>#</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Alerts</th>
                        <th>Label</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    @foreach($users as $user)
                    <tr>
                        <td>
                          <span class="fw-medium">{{ $user->name }} ({{$user->id}})</span>
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td><span class="badge bg-label-primary me-1">{{ $user->roles->pluck('name')->join(', ') }}</span></td>
                        <td>{{ $user->alert_count }}</td>
                        <td>
                            @if($user->nivel_alerta === 'critical')
                            <span class="badge bg-label-danger">Critical</span>
                            @elseif($user->nivel_alerta === 'warning')
                            <span class="badge bg-label-warning">Warning</span>
                            @elseif($user->nivel_alerta === 'normal')
                            <span class="badge bg-label-success">Normal</span>
                            @else
                            <span class="badge bg-label-secondary">Sin datos</span>
                            @endif
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="ti ti-dots-vertical"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ti ti-pencil me-1 text-primary"></i> Edit</a>
                              <a class="dropdown-item waves-effect" href="javascript:void(0);"><i class="ti ti-trash me-1 text-danger"></i> Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    @endforeach
                    </tbody>
                  </table>
                    <div class="m-3 ">
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
              </div>
@endsection