@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Изменение события') }}</div>

                    <div class="card-body">
                        <form method="POST" id="event_form" action="">
                            @csrf
                            <input id="event_form_method" type="hidden" name="_method" value="">
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                           class="form-control @error('name') is-invalid @enderror" name="name"
                                           value="{{ $event->name }}" required autofocus>

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
                                           value="{{ $event->cost }}" required>

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
                                           name="type" value="{{ $event->type }}" required>

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
                                        <option value="{{$event->company->id}}"
                                                selected>{{$event->company->name}}</option>
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
                                        <option value="{{$event->user_id}}" selected>{{$event->user->name}}</option>
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
                                    <input id="date" type="date"
                                           min={{date("Y-m-d")}} max={{\Illuminate\Support\Carbon::now()->addWeek(2)->format("Y-m-d")}}
                                               value={{ $event->date }}
                                               class="form-control"
                                           name="date" required>

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
                                        <option value="{{$event->shift_id}}" disabled selected
                                                hidden>{{$event->shift->name}}</option>
                                    </select>

                                    @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-primary"
                                            onclick="$('#event_form').attr('action','{{ route('event.update', $event->id) }}');$('#event_form_method').attr('value','patch');$('#event_form').submit()">
                                        {{ __('Edit event') }}
                                    </button>
                                </div>
                            </div>

                            <div class="form-group row mb-2">
                                <div class="col-md-6 offset-md-4">
                                    <button type="button" class="btn btn-danger"
                                            onclick="$('#event_form').attr('action','{{ route('event.destroy', $event->id) }}');$('#event_form_method').attr('value','delete');$('#event_form').submit()">
                                        {{ __('Delete an event') }}
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
                $("#user_id").empty();
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
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "get",
                    url: "/api/event/" + $("#company_id").val() + '/' + $("#date").val(),
                    success: function (result) {
                        if (result.length == 0) {
                            $("#shift").append('<option value="" disabled selected hidden>На эту дату нет доступных смен</option>')
                        } else {
                            $.each(result, function (index, value) {
                                $("#shift").append('<option value="' + index + '">' + value + '</option>')
                            })
                        }
                    },
                    error: function () {
                        $("#shift").append('<option value="" disabled selected hidden>На эту дату нет доступных смен</option>')
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
                    url: "/api/event/" + $("#company_id").val() + '/' + $("#date").val(),
                    success: function (result) {
                        console.log($("#company_id").val());
                        console.log(result);
                        if (result.length == 0) {
                            $("#shift").append('<option value="" disabled selected hidden>На эту дату нет доступных смен</option>')
                        } else {
                            $.each(result, function (index, value) {
                                $("#shift").append('<option value="' + index + '">' + value + '</option>')
                            })
                        }
                    },
                    error: function () {
                        $("#shift").append('<option value="" disabled selected hidden>На эту дату нет доступных смен</option>')
                    },
                });
            })
        });
    </script>
@endsection
