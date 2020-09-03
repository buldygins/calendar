@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Создание события') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('event.store') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="cost" class="col-md-4 col-form-label text-md-right">{{ __('Cost') }}</label>

                                <div class="col-md-6">
                                    <input id="cost" type="text"
                                           class="form-control @error('cost') is-invalid @enderror" name="cost"
                                           value="{{ old('cost') }}" required>

                                    @error('cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                                <div class="col-md-6">
                                    <input id="type" type="text"
                                           class="form-control @error('type') is-invalid @enderror"
                                           name="type" value="{{ old('type') }}" required>

                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="company_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Company') }}</label>

                                <div class="col-md-6">
                                    <select id="company_id" class="form-control" name="company_id" required>
                                        <option value="" selected disabled hidden>Choose here</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}} </option>
                                        @endforeach
                                    </select>

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="user_id"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Manager') }}</label>

                                <div class="col-md-6">
                                    <select id="user_id" class="form-control" name="user_id" required>
                                        <option value="" disabled selected hidden>First select company</option>
                                    </select>

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="date" min={{date("Y-m-d")}} max={{\Illuminate\Support\Carbon::now()->addWeek(2)->format("Y-m-d")}}
                                        value={{date("Y-m-d")}}
                                        class="form-control"
                                    name="date" value="{{ old('date') }}" required>

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Shift') }}</label>

                                <div class="col-md-6">
                                    <select id="shift" class="form-control" name="shift_id" required>
                                        <option value="" disabled selected hidden>First select date</option>
                                    </select>

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" >
                                        {{ __('Make an event') }}
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
@section('script')
    <script>
        $(document).ready(function () {
            $("#company_id").change(function () {
                document.getElementById('date').valueAsDate = new Date();
                $("#user_id").empty();
                $("#shift").empty();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: "/api/company/" + $("#company_id").val() + "/users",
                    success: function (result) {
                        $.each(result, function (index, value) {
                            $("#user_id").append('<option value="' + index + '">' + value + '</option>')
                        })
                    },
                    error: function () {
                        $("#user_id").append('<option value="" disabled selected hidden>В этой компании нет ответственных</option>')
                    },
                });
            });
            $("#date").change(function () {
                $("#shift").empty();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: "/api/event/" + $("#company_id").val() +'/'+ $("#date").val(),
                    success: function (result) {
                        $.each(result, function (index, value) {
                            $("#shift").append('<option value="' + index + '">' + value + '</option>')
                        })
                    },
                    error: function () {
                        $("#shift").append('<option value="" disabled selected hidden>На эту дату нет доступных смен</option>')
                    },
                });
            })
        });
    </script>
@endsection
