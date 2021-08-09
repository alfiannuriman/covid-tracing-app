@extends('admin.layouts.template', ['meta' => $meta])
@section('content')

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Alerting</h3>
            </div>
            <div class="col text-right">
              <a href="{{ route('alerting.create') }}" class="btn btn-primary">Create</a>
            </div>
          </div>
          
          <div class="align-items-center mt-3 mb-3">
            <form action="{{ route('alerting.index') }}" method="GET">
              <div class="form-group row">
                <label for="filterCaseNumber" class="col-4 col-md-2 col-form-label">Case number : </label>
                <div class="col-8 col-md-4">
                  <input name="case_number" type="text" id="filterCaseNumber" class="form-control" placeholder="Case number" value="{{ isset($_GET['case_number']) ? $_GET['case_number'] : '' }}">
                </div>
              </div>
              <div class="form-group row">
                <label for="filterUser" class="col-4 col-md-2 col-form-label">User : </label>
                <div class="col-8 col-md-4">
                  <input name="user_id" type="text" id="filterUser" class="form-control" placeholder="User" value="{{ isset($_GET['user']) ? $_GET['user'] : '' }}">
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
                  <th scope="col">User name</th>
                  <th scope="col">Case number</th>
                  <th scope="col">Have symptoms</th>
                  <th scope="col">First time symptoms appear</th>
                  <th scope="col">Description</th>
                  <th scope="col">Is alert active</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($models as $model)
                  <tr>
                    <td>{{ $model->user->name }}</td>
                    <td>{{ $model->case_number }}</td>
                    <td>{{ ($model->is_have_symptoms == 1) ? 'Yes' : 'No' }}</td>
                    <td>{{ date('d-m-Y', strtotime($model->symptoms_appear_date)) }}</td>
                    <td>{{ $model->description }}</td>
                    <td>{{ ($model->is_active == 1) ? 'Yes' : 'No' }}</td>
                    <td>
                      <div class="row">
                        <div class="col-2">
                          @if ($model->is_active == 1)
                            <form action="{{ route('alerting.resolve', ['id' => $model->id]) }}" method="POST">
                              @csrf
        
                              <button 
                                class="btn btn-icon btn-primary btn-sm" 
                                type="submit"
                                data-toggle="tooltip" 
                                data-placement="top" 
                                title="Resolve alert"
                                onclick="return confirm('Are you sure to resolve this alert ?')"
                              >
                                <span class="btn-inner--icon"><i class="fas fa-check-double"></i></span>
                              </button>
                            </form>                              
                          @endif
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