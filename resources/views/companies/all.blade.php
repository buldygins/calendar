@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($companies as $company)
                <div class="col-3 m-3">
                    <a href="{{route('company.edit', $company->id)}}"><h4>{!! $company->name !!}</h4></a>
                    <span>Кол-во событий: {{count($company->events)}}</span><br>
                    <span>Кол-во ответственных сотрудников: {{count($company->users)}}</span>
                </div>
            @endforeach
        </div>
        <div class="form-group row mb-0">
            <div class=" offset-md-1">
                <a href="{{route('company.create')}}" class="btn btn-primary">
                    {{ __('Make a company') }}
                </a>
            </div>
        </div>
    </div>
@endsection
