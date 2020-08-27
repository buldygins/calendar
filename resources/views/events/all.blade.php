@extends('layouts.app')

@section('content')
    <div class="container">
        <select id="company" class="form-control col-3 m-1"
                onChange="window.document.location='/events/'+this.options[this.selectedIndex].value;">
            @foreach($companies as $company)
                <option class="custom-select" value="{{$company->id}}"
                        @if($company->id == $exactcompany->id) selected @endif>{{__($company->name)}}
                </option>
            @endforeach
        </select>
        <div class="table-responsive">
            @if(count($exactcompany->events) > 0)
                <table class="table border">
                    <thead>
                    <tr class="">
                        <th scope="col" class="border">#</th>
                        @for($i = 0; $i < 14; $i++)
                            <th scope="col"
                                class="border">{{\Illuminate\Support\Carbon::now()->addDay($i)->format("d M")}}</th>
                        @endfor
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($shifts as $shift)
                        <tr class="">
                            <th scope="row">{{$shift->name}}</th>
                            @for($i = 0; $i < 14; $i++)
                                @foreach($exactcompany->events as $event)
                                    @if($event->date == \Illuminate\Support\Carbon::now()->addDay($i)->format("Y-m-d") and $event->shift_id == $shift->id )
                                        <td class="border">
                                            <div class="card">
                                                <div class="card-header p-1 text-center">
                                                    <a href="{{route('event.edit', $event->id)}}">{{$event->name}}</a>
                                                </div>
                                                <div class="card-body p-1">
                                                    <span>Cost: {{$event->cost}}</span><br>
                                                    <span>Type: {{$event->type}}</span><br>
                                                    <span>Manager: {{$event->user->name}}</span><br>
                                                </div>
                                            </div>
                                        </td>@break
                                    @else
                                        @if($loop->last)
                                            <td class="border"></td>
                                        @endif
                                    @endif
                                @endforeach
                            @endfor
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <span>This company doesn't have events</span>
            @endif
        </div>
        <div class="form-group row mb-0">
            <div class=" offset-md-1">
                <a href="{{route('event.create')}}" class="btn btn-primary">
                    {{ __('Make an event') }}
                </a>
            </div>
        </div>
    </div>
@endsection
