@extends('admin.layouts.template', ['meta' => $meta])
@section('content')

  <div class="row">
    <div class="col-xl-12">
      <div class="card">
        <div class="card-header border-0">
          <div class="row align-items-center">
            <div class="col">
              <h3 class="mb-0">Create</h3>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-12">
              <form role="form" method="POST" action="{{ route('places.update', ['place' => $model->id]) }}">
                @csrf
                @method('PUT')
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input name="name" type="text" id="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ $model->name }}">
                      @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label for="address">Address</label>
                      <textarea name="address" type="text" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Address" rows="3">{{ $model->address }}</textarea>
                      @error('address')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <a href="{{ route('places.index') }}" class="btn btn-secondary">Cancel</a>
                  </div>

                  <div class="col-2 offset-8">
                    <button class="btn btn-primary float-right" type="sumbit">Submit</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@stop