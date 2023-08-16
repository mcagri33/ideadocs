@extends('layouts.layoutMaster')

@section('title', 'Tüm Evraklar')

@section('content')
  @can('tum-evraklar')
  <div class="container">
    <h1>@yield('title')</h1>

    <table class="table">
      <thead>
      <tr>
        <th>Kullanıcı Adı</th>
        <th>Şirket İsmi</th>
        <th>İşlemler</th>
      </tr>
      </thead>
      <tbody>
      @foreach ($usersDocs as $user)
        <tr>
          <td>{{ $user->name }}</td>
          <td>{{ $user->company }}</td>
          <td>
            <a href="{{route('castle.user.evrak',$user->uuid)}}">Detay Gör</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
  @endcan
@endsection
