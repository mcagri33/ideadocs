@extends('layouts/layoutMaster')

@section('title', 'Kullanıcı Güncelle')

@section('page-script')
  <script src="{{asset('assets/js/form-basic-inputs.js')}}"></script>
@endsection

@section('content')
  @include('layouts.alert')
  <div class="row">
    <div class="col-xl-12">
      <!-- HTML5 Inputs -->
      <div class="card mb-4">
        <h5 class="card-header"> @yield('title')</h5>
        <div class="card-body">
          <form action="{{route('castle.user.update',$user->uuid)}}" method="post">
            @csrf
            <div class="mb-3 row">
              <label for="html5-email-input" class="col-md-2 col-form-label">Email</label>
              <div class="col-md-10">
                <input class="form-control" type="email" name="email" value="{{$user->email}}" id="html5-email-input" />
              </div>
            </div>

            <div class="mb-3 row">
              <label for="html5-name-input" class="col-md-2 col-form-label">Ad Soyad</label>
              <div class="col-md-10">
                <input type="text" class="form-control"  name="name" value="{{$user->name}}" placeholder="John Doe" />
              </div>
            </div>

            <div class="mb-3 row">
              <label for="html5-name-input" class="col-md-2 col-form-label">Şirket Adı</label>
              <div class="col-md-10">
                <input type="text" class="form-control" value="{{$user->company}}" name="company"/>
              </div>
            </div>

            <div class="mb-3 row">
              <label for="html5-name-input" class="col-md-2 col-form-label">Telefon</label>
              <div class="col-md-10">
                <input type="text" class="form-control" value="{{$user->phone}}" name="phone"/>
              </div>
            </div>

            <div class="mb-3 row">
              <label class="html5-select-input">Durumu</label>
              <div class="col-md-10">
                <select class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        name="status">
                  <option value="1" {{$user->status == 1 ? "selected" : ""}}>Aktif</option>
                  <option value="0" {{$user->status == 0 ? "selected" : ""}}>Pasif</option>
                </select>
              </div>
            </div>


            <div class="mb-3 row">
              <label for="role" class="html5-select-input">Roller</label>
              <div class="col-md-10">
                <select id="role" name="role" autocomplete="role-name"
                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  @foreach ($roles as $role)
                    <option value="{{ $role->name }}" {{ $user->roles->contains('id', $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>


            <div class="mb-3 row">
              <div class="d-grid">
                <button class="btn btn-primary" type="submit">Güncelle</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
