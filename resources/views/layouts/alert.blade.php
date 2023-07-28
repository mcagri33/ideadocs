@if ($message = Session::get('success'))
  <div class="alert border-0 bg-light-success alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
      <div class="fs-3 text-success"><i class="bi bi-check-circle-fill"></i>
      </div>
      <div class="ms-3">
        <div class="text-success">{{ $message }}</div>
      </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


@if ($message = Session::get('error'))
  <div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
      <div class="fs-3 text-danger"><i class="bi bi-x-circle-fill"></i>
      </div>
      <div class="ms-3">
        <div class="text-danger">{{ $message }}</div>
      </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


@if ($message = Session::get('warning'))
  <div class="alert border-0 bg-light-warning alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
      <div class="fs-3 text-warning"><i class="bi bi-exclamation-triangle-fill"></i>
      </div>
      <div class="ms-3">
        <div class="text-warning">{{ $message }}</div>
      </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


@if ($message = Session::get('info'))
  <div class="alert border-0 bg-light-info alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
      <div class="fs-3 text-info"><i class="bi bi-info-circle-fill"></i>
      </div>
      <div class="ms-3">
        <div class="text-info">{{ $message }}</div>
      </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif


@if ($errors->any())
  <div class="alert border-0 bg-light-danger alert-dismissible fade show py-2">
    <div class="d-flex align-items-center">
      <div class="fs-3 text-danger"><i class="bi bi-x-circle-fill"></i>
      </div>
      <div class="ms-3">
        @foreach ($errors->all() as $error)
          <div class="text-danger">{{ $error }}</div>
        @endforeach
      </div>
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif
