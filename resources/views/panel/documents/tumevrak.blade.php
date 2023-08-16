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
            <a href="#" data-toggle="modal" data-target="#userModal{{ $user->id }}">Detay Gör</a>
          </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="userModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="userModalLabel{{ $user->id }}" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel{{ $user->id }}">{{ $user->name }} - Evraklar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <h4 class="mb-3">Kullanıcı Detayları</h4>
                <p><strong>Kullanıcı Adı:</strong> {{ $user->name }}</p>
                <p><strong>Şirket İsmi:</strong> {{ $user->company }}</p>
                <hr>
                <h4 class="mb-3">Kullanıcının Evrakları</h4>
                <ul class="list-group">
                  @forelse ($user->documents as $document)
                    <li class="list-group-item">{{ $document->document_name }} - {{ $document->document_type }} -
                      <a href="{{ route('castle.file.download', $document->id) }}" class="btn btn-sm btn-primary">İndir</a>
                    </li>
                  @empty
                    <li class="list-group-item">Kullanıcının evrakı bulunmamaktadır.</li>
                  @endforelse
                </ul>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
              </div>
            </div>
          </div>
        </div>
      @endforeach
      </tbody>
    </table>
  </div>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  @endcan
@endsection
