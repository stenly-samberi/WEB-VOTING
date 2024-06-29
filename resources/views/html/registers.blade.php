@extends('main.layout')

@section('content')
<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <h5 class="card-title fw-semibold mb-4">Registered</h5>
      <div class="card">
        <div class="card-body">
          @include('alert.message')
          <form action="{{ route('register.store') }}" method="POST">
            @csrf
            <div class="row">
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Nama</label>
                  <input name="nama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>  
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="username" class="form-label">Username</label>
                  <input name="username" type="text" class="form-control" id="username">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input name="password" type="password" class="form-control" id="password">
                </div>
              </div>
              <div class="col-lg-12">
                <div class="mb-3">
                  <label for="role" class="form-label">Role</label>
                  <select name="role" class="form-control" id="role">
                    <option value="admin">Admin</option>
                    <option value="juri">Juri</option>
                  </select>
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>

      <div class="card mb-0">
        <div class="card-body">
          <table class="table table-striped">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Username</th>
                <th scope="col">Role</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($datajemaat as $key => $data)
              <tr>
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $data->name }}</th>
                <td>{{ $data->username }}</th>
                <td>{{ $data->role }}</th>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->updated_at }}</td>
                <td class="d-flex">
                  
                  <form action="{{ route('register.destroy', $data->id_user) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                      <i class="ti ti-trash"></i>
                    </button>
                  </form>

                  <a href="{{ route('register.edit', $data->id_user) }}" class="btn btn-success">
                    <i class="ti ti-edit"></i>
                  </a>
                </td>
              </tr>
              @empty
              <tr>
                <td colspan="7" class="text-center">Tidak ada data</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
