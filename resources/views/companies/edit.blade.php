@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Изменение события') }}</div>

                    <div class="card-body">
                        <form method="POST" id="form" action="">
                            @csrf
                            <input id="form_method" type="hidden" name="_method" value="">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $company->name }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary"
                                            onclick="$('#form').attr('action','{{ route('company.update', $company->id) }}');$('#form_method').attr('value','patch');$('#form').submit()">
                                        {{ __('Edit company') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-danger"
                                            onclick="$('#form').attr('action','{{ route('company.destroy', $company->id) }}');$('#form_method').attr('value','delete');$('#form').submit()">
                                        {{ __('Delete a company') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
