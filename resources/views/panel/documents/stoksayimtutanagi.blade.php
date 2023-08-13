@extends('layouts/layoutMaster')

@section('title', 'Stok Sayım Tutanağı')


@section('content')
  <h4 class="fw-bold py-3 mb-4">
    @yield('title')
  </h4>

  <div class="col-12">
    <div class="card mb-4">
      <h5 class="card-header">
        @yield('title')
      </h5>
      <div class="card-body">
        <form id="uploadForm"  action="{{route('castle.stoksayimtutanagi.store')}}" enctype="multipart/form-data" method="post">
          @csrf
          <div class="fallback">
            <input name="file" type="file" />
          </div>

          <div class="mb-3 row">
            <label for="html5-name-input" class="col-md-2 col-form-label">Dosya Adı</label>
            <div class="col-md-10">
              <input type="text" class="form-control"  name="document_name" value="{{old('document_name')}}" placeholder="Dosyanızı Adlandırın" />
              @error("name")
              <span class="text-danger">{{$message}}</span>
              @enderror
            </div>
          </div>


          <div class="d-grid">
            <button class="btn btn-primary" type="submit">Gönder</button>
          </div>
        </form>

        <div id="progress" style="display: none;">
          Yükleniyor: <span id="percent">0%</span>
        </div>

      </div>
    </div>
  </div>


  <hr>


  @include('layouts.alert')

  <div class="card">
    <div class="table-responsive text-nowrap">
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
        @foreach($stokSayimTutanagi as $sst)
          <tr>
            <td>{{ $stokSayimTutanagi->perPage() * ($stokSayimTutanagi->currentPage() - 1) + $count }}</td>
            <?php $count++; ?>
            <td>{{ $sst->document_name }}</td>
            <td>{{ $sst->document_type }}</td>
            <td>{{ $sst->created_at }}</td>
            <td>
              @if($sst->status == 2)
                <span class="badge bg-label-warning me-1">Onay Bekliyor</span>
              @elseif($sst->status == 1)
                <span class="badge bg-label-primary me-1">Onaylandı</span>
              @else
                <span class="badge bg-label-danger me-1">Red Edildi</span>
              @endif
            </td>
            <td><a href="{{ route('castle.stoksayimtutanagi.download', ['file' => $sst->id]) }}">Dosyayı İndir</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {!! $stokSayimTutanagi->links() !!}
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    document.getElementById('uploadForm').addEventListener('submit', function(event) {
      event.preventDefault();
      const form = event.target;
      const formData = new FormData(form);

      const progressDiv = document.getElementById('progress');
      const percentSpan = document.getElementById('percent');

      axios.post(form.action, formData, {
        onUploadProgress: function(progressEvent) {
          const percent = Math.round((progressEvent.loaded * 100) / progressEvent.total);
          percentSpan.textContent = percent + '%';
        }
      }).then(response => {
        progressDiv.style.display = 'none';

        // Use SweetAlert for success message
        Swal.fire({
          icon: 'success',
          title: 'Başarılı!',
          text: 'Dosya başarıyla yüklendi.',
        }).then(() => {
          // Redirect to the index page after SweetAlert confirmation
          window.location.href = "{{ route('castle.stoksayimtutanagi.index') }}";
        });
      }).catch(error => {
        progressDiv.style.display = 'none';
        Swal.fire({
          icon: 'error',
          title: 'Hata!',
          text: 'Dosya yüklenirken bir hata oluştu.',
        });
      });

      progressDiv.style.display = 'block';
    });
  </script>


@endsection
