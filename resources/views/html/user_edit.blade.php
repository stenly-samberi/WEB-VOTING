@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Edit Register</h5>
      <div class="card">
        <div class="card-body">
          @include('alert.message')
          <form action="{{ route('register.update', $data->id_user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input name="nama" type="text" class="form-control" id="exampleInputEmail1" value="{{ $data->name }}" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input name="username" type="text" class="form-control" id="username" value="{{ $data->username }}">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">Password (Kosongkan jika tidak diubah)</label>
                  <input name="password" type="password" class="form-control" id="password">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="role" class="form-control" id="role">
                    <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="juri" {{ $data->role == 'juri' ? 'selected' : '' }}>Juri</option>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
