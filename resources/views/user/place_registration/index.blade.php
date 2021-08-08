@extends('admin.layouts.template', ['meta' => $meta])
@section('content')

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Place Registration</h3>
            </div>
            <div class="col text-right">
              <a href="{{ route('place-registration.create') }}" class="btn btn-primary">Create</a>
            </div>
          </div>
          
          <div class="align-items-center mt-3 mb-3">
            <form action="{{ route('place-registration.index') }}" method="GET">
              <div class="form-group row">
                <label for="filterName" class="col-4 col-md-2 col-form-label">Name : </label>
                <div class="col-8 col-md-4">
                  <input name="name" type="text" id="filterName" class="form-control" placeholder="Name" value="{{ isset($_GET['name']) ? $_GET['name'] : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="filterPlaceCode" class="col-4 col-md-2 col-form-label">User : </label>
                <div class="col-8 col-md-4">
                  <input name="user_id" type="text" id="filterPlaceCode" class="form-control" placeholder="Place code" value="{{ isset($_GET['place_code']) ? $_GET['place_code'] : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-md-2 col-md-4 col-6 offset-4">
                  <button class="btn btn-icon btn-default" type="submit">
                    <span class="btn-inner--icon"><i class="fas fa-filter"></i></span>
                    <span class="btn-inner--text">Filter</span>
                  </button>
                </div>
              </div>
            </form>
          </div>

        </div>
        <div class="card-body">
          <div class="table-responsive">
            <!-- Projects table -->
            <table class="table align-items-center table-flush">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Place name</th>
                  <th scope="col">Place address</th>
                  <th scope="col">Place code</th>
                  <th scope="col">Type</th>
                  <th scope="col">Time</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($models as $model)
                  <tr>
                    <td>{{ $model->place->name }}</td>
                    <td>{{ $model->place->address }}</td>
                    <td>{{ $model->place->place_code }}</td>
                    <td>{{ $model->place_registration_type->name }}</td>
                    <td>{{ date('d-m-Y H:i:s', strtotime($model->created_at)) }}</td>
                    <td>
                      <div class="row">
                        <div class="col-2">
                          <a 
                            href="{{ route('place-registration.edit', ['place_registration' => $model->id]) }}"
                            class="btn btn-icon btn-default btn-sm" 
                            data-toggle="tooltip" 
                            data-placement="top" 
                            title="Edit"
                          >
                            <span class="btn-inner--icon"><i class="fas fa-pencil-alt"></i></span>
                          </a>
                        </div>
                        <div class="col-2 offset-1">
                          <form action="{{ route('place-registration.destroy', ['place_registration' => $model->id]) }}" method="POST">
                            @csrf @method('DELETE')
      
                            <button 
                              class="btn btn-icon btn-danger btn-sm" 
                              type="submit"
                              data-toggle="tooltip" 
                              data-placement="top" 
                              title="Delete"
                              onclick="return confirm('Are you sure to delete data ?')"
                            >
                              <span class="btn-inner--icon"><i class="fas fa-trash-alt"></i></span>
                            </button>
                          </form>
                        </div>
                      </div>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
          <div class="py-3">
            {{ $models->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
  
@stop