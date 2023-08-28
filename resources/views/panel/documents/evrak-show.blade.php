@extends('layouts.layoutMaster')

@section('title', 'Evrak Görüntüle')
@section('vendor-style')
  <meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')
  @can('tum-evraklar')

    <h4 class="fw-bold py-3 mb-4">
      {{ $users->first()->company }} - @yield('title')
    </h4>

    @include('layouts.alert')

    <div class="card">
      <div class="table-responsive text-nowrap">
        <div class="d-flex justify-content-end mb-3">
          <!-- Durum Filtresi -->
          <label for="statusFilter">Durum Filtresi:</label>
          <select id="statusFilter">
            <option value="">Tümü</option>
            <option value="2">Onay Bekliyor</option>
            <option value="1">Onaylandı</option>
            <option value="0">Reddedildi</option>
          </select>
          <button id="filterButton" class="ml-2">Filtrele</button>
        </div>
        <table class="table">
          <thead>
          <tr>
            <th>#</th>
            <th>Dosya Adı</th>
            <th>Dosya Türü</th>
            <th>Oluşturulma Tarihi</th>
            <th>Durumu</th>
            <th>İndir</th>
          </tr>
          </thead>

          <tbody class="table-border-bottom-0">
          <?php $count = 1; ?>
          @foreach ($users as $user)
            @foreach ($user->documents as $document)
              <tr>
                <td>{{ $users->perPage() * ($users->currentPage() - 1) + $count }}</td>
                <?php $count++; ?>
                <td>{{ $document->document_name }}</td>
                <td>{{ $document->document_type }}</td>
                <td>{{ $document->created_at }}</td>
                <td>
                  <div class="dropdown">
                    <button class="btn btn-sm dropdown-toggle @if ($document->status === 0) btn-danger @elseif ($document->status === 1) btn-success @elseif ($document->status === 2) btn-warning @endif" type="button" id="statusDropdown{{ $document->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      @if ($document->status === 2)
                        Onay Bekliyor
                      @elseif ($document->status === 1)
                        Onaylandı
                      @elseif ($document->status === 0)
                        Reddedildi
                      @endif
                    </button>
                    <div class="dropdown-menu" aria-labelledby="statusDropdown{{ $document->id }}">
                      <a class="dropdown-item" href="javascript:void(0);" onclick="updateDocumentStatus('{{ route("update.document.status", $document->id) }}', 0)">Reddet</a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="updateDocumentStatus('{{ route("update.document.status", $document->id) }}', 1)">Onayla</a>
                      <a class="dropdown-item" href="javascript:void(0);" onclick="updateDocumentStatus('{{ route("update.document.status", $document->id) }}', 2)">Onay Bekliyor</a>
                    </div>
                  </div>
                </td>
                <td><a href="{{ route('castle.file.download', $document->id) }}">Dosyayı İndir</a></td>

              </tr>
            @endforeach
          @endforeach
          </tbody>
        </table>
        <div class="d-flex justify-content-center">
          {!! $users->links() !!}
        </div>
      </div>
    </div>

    <script>
      function updateDocumentStatus(route, status) {
        $.ajax({
          url: route,
          method: 'POST',
          data: { _method: 'POST', _token: '{{ csrf_token() }}', status: status },
          success: function (response) {
            window.location.reload();
          },
          error: function (xhr, status, error) {
            console.error(error);
            alert('Evrak durumu güncellenirken bir hata oluştu.');
          }
        });
      }
    </script>
    <script>
      document.getElementById('filterButton').addEventListener('click', function () {
        const selectedStatus = document.getElementById('statusFilter').value;

        window.location.href = "{{ route('castle.user.evrak', ['userUuid' => $users->first()->uuid]) }}" + "?status=" + selectedStatus;
      });

      // ... Diğer script kodları ...
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  @endcan
@endsection
