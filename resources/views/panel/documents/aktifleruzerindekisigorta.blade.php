@extends('layouts/layoutMaster')

@section('title', 'Aktifler Uzerindeki Sigorta Teminat Tutarları')


@section('vendor-style')
  <link rel="stylesheet" href="{{asset('assets/vendor/libs/dropzone/dropzone.css')}}" />
@endsection

@section('vendor-script')
  <script src="{{asset('assets/vendor/libs/dropzone/dropzone.js')}}"></script>
@endsection

@section('page-script')
  <script src="{{asset('assets/js/forms-file-upload.js')}}"></script>
@endsection


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
        <form action="{{route('castle.aktifleruzerindekisigorta.store')}}" enctype="multipart/form-data" method="post">
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
        @foreach($aktifleruzerindekisigorta as $aus)
          <tr>
            <td>{{ $aktifleruzerindekisigorta->perPage() * ($aktifleruzerindekisigorta->currentPage() - 1) + $count }}</td>
            <?php $count++; ?>
            <td>{{ $aus->document_name }}</td>
            <td>{{ $aus->document_type }}</td>
            <td>{{ $aus->created_at }}</td>
            <td>
              @if($aus->status == 2)
                <span class="badge bg-label-warning me-1">Onay Bekliyor</span>
              @elseif($aus->status == 1)
                <span class="badge bg-label-primary me-1">Onaylandı</span>
              @else
                <span class="badge bg-label-danger me-1">Red Edildi</span>
              @endif
            </td>
            <td><a href="{{ route('castle.aktifleruzerindekisigorta.download', ['file' => $aus->id]) }}">Dosyayı İndir</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {!! $aktifleruzerindekisigorta->links() !!}
      </div>
    </div>
  </div>

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
        alert('Dosya başarıyla yüklendi.');
      }).catch(error => {
        progressDiv.style.display = 'none';
        alert('Dosya yüklenirken bir hata oluştu.');
      });

      progressDiv.style.display = 'block';
    });
  </script>
@endsection
