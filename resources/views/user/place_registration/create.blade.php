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
              <form role="form" method="POST" action="{{ route('place-registration.store') }}">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="name">Place code</label>
                      <input name="place_id" type="text" id="name" class="form-control @error('place_id') is-invalid @enderror" placeholder="Place code">
                      @error('place_id')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="place_registration_type_id">Type</label>
                      <select name="place_registration_type_id" id="place_registration_type_id" class="form-control @error('place_registration_type_id') is-invalid @enderror">
                        @foreach ($form_options['place_registration_types'] as $type)
                          <option value="{{ $type->id }}">{{ $type->name }}</option>
                        @endforeach
                        @error('place_registration_type_id')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <a href="{{ route('place-registration.index') }}" class="btn btn-secondary">Cancel</a>
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