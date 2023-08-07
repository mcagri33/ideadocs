@extends('layouts/layoutMaster')

@section('title', 'Roller')

@section('content')
  <h4 class="fw-bold py-3 mb-4">
    @yield('title')
  </h4>

  <div class="d-flex justify-content-between mb-3">
    <div class="nav-align-right">
      <a class="btn btn-primary btn-toggle-sidebar" href="{{ route('castle.role.add') }}" style="color: white">
        <i class="ti ti-plus me-1"></i>
        Rol Ekle
      </a>
    </div>
  </div>

  @include('layouts.alert')

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Rol Adı</th>
          <th>İşlemler</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        <?php $count = 1; ?>
        @foreach($roles as $role)
          <tr>
            <td>{{ $roles->perPage() * ($roles->currentPage() - 1) + $count }}</td>
            <?php $count++; ?>
            <td>{{ $role->name }}</td>
            <td>
              <div class="dropdown">
                <a class="btn p-0 dropdown-toggle hide-arrow" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('castle.role.edit', $role->id) }}"><i class="ti ti-pencil me-1"></i> Düzenle</a></li>
                  <li><a class="dropdown-item" href="{{ route('castle.role.delete', $role->id) }}"><i class="ti ti-trash me-1"></i> Sil</a></li>
                </ul>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {!! $roles->links() !!}
      </div>
    </div>
  </div>


@endsection
