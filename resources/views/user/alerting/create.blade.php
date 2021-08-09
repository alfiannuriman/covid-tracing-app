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
              <form role="form" method="POST" action="{{ route('alerting.store') }}">
                @csrf
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-control-label" for="isHaveSymptoms">Do you have symptoms</label>
                      <select name="is_have_symptoms" id="isHaveSymptoms" class="form-control @error('is_have_symptoms') is-invalid @enderror">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                      </select>
                      @error('is_have_symptoms')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label for="name">Date when symptoms appear</label>
                      <input name="symptoms_appear_date" type="text" id="name" class="form-control @error('symptoms_appear_date') is-invalid @enderror" placeholder="YYYY-mm-dd" aria-describedby="passwordHelpBlock">
                      <small id="passwordHelpBlock" class="form-text text-muted">
                        If you don't have symptoms then fill the input with date when you got tested.
                      </small>
                      @error('symptoms_appear_date')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>

                    <div class="form-group">
                      <label class="form-control-label">Describe your condition</label>
                      <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"></textarea>
                      @error('description')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-2">
                    <a href="{{ route('alerting.index') }}" class="btn btn-secondary">Cancel</a>
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