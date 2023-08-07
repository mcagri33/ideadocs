@extends('layouts/layoutMaster')

@section('title', 'Yönetim Kurulu İmzaları')


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
        <form action="{{route('castle.yonetimkuruluimzalari.store')}}" enctype="multipart/form-data" method="post">
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
        @foreach($yonetimKuruluEvraklari as $yke)
          <tr>
            <td>{{ $yonetimKuruluEvraklari->perPage() * ($yonetimKuruluEvraklari->currentPage() - 1) + $count }}</td>
            <?php $count++; ?>
            <td>{{ $yke->document_name }}</td>
            <td>{{ $yke->document_type }}</td>
            <td>{{ $yke->created_at }}</td>
            <td>
              @if($yke->status == 2)
                <span class="badge bg-label-warning me-1">Onay Bekliyor</span>
              @elseif($yke->status == 1)
                <span class="badge bg-label-primary me-1">Onaylandı</span>
              @else
                <span class="badge bg-label-danger me-1">Red Edildi</span>
              @endif
            </td>
            <td><a href="{{ route('castle.yonetimkuruluimzalari.download', ['file' => $yke->id]) }}">Dosyayı İndir</a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
      <div class="d-flex justify-content-center">
        {!! $yonetimKuruluEvraklari->links() !!}
      </div>
    </div>
  </div>


@endsection
