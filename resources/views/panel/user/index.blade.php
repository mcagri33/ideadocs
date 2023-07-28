@extends('layouts/layoutMaster')

@section('title', 'Kullanıcılar')

@section('content')
  <h4 class="fw-bold py-3 mb-4">
    @yield('title')
  </h4>

  <div class="d-flex justify-content-between mb-3">
    <div class="nav-align-right">
      <a class="btn btn-primary btn-toggle-sidebar" href="{{ route('castle.user.add') }}" style="color: white">
        <i class="ti ti-plus me-1"></i>
        Kullanıcı Ekle
      </a>
    </div>
    <form action="{{ route('castle.user.search') }}" method="GET" class="d-flex">
      @csrf
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Arama yap...">
        <button type="submit" class="btn btn-outline-primary"><i class="ti ti-search"></i></button>
      </div>
    </form>
  </div>

  @include('layouts.alert')

  <div class="card">
    <div class="table-responsive text-nowrap">
      <table class="table">
        <thead>
        <tr>
          <th>#</th>
          <th>Ad Soyad</th>
          <th>Şirket İsmi</th>
          <th>Rolü</th>
          <th>Durumu</th>
          <th>İşlemler</th>
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        <?php $count = 1; ?>
        @foreach($users as $user)
          <tr>
            <td>{{ $users->perPage() * ($users->currentPage() - 1) + $count }}</td>
            <?php $count++; ?>
            <td>{{ $user->name }}</td>
            <td>{{ $user->company }}</td>
            <td>
              @if(!empty($user->getRoleNames()))
                @foreach($user->getRoleNames() as $v)
                  <span class="badge rounded-pill bg-dark">{{ $v }}</span>
                @endforeach
              @endif
            </td>
            <td>
              @if($user->status == 1)
                <span class="badge bg-label-primary me-1">Aktif</span>
              @else
                <span class="badge bg-label-danger me-1">Pasif</span>
              @endif
            </td>
            <td>
              <div class="dropdown">
                <a class="btn p-0 dropdown-toggle hide-arrow" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="ti ti-dots-vertical"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('castle.user.edit', $user->uuid) }}"><i class="ti ti-pencil me-1"></i> Düzenle</a></li>
                  <li><a class="dropdown-item" href="{{ route('castle.user.delete', $user->uuid) }}"><i class="ti ti-trash me-1"></i> Sil</a></li>
                </ul>
              </div>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {!! $users->links() !!}
      </div>
    </div>
  </div>


@endsection
