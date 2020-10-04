@extends('layouts.app')

@section('content')
    <div class="container">
        <event-table></event-table>
        <button-counter></button-counter>
        <example-component></example-component>
        <div class="container">
            @foreach($companies as $company)
                @if(count($company->events) == 0)@continue
                @endif
                <h4>{{$company->name}}</h4>
                <table class="table border table-responsive">
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
                                @foreach($company->events as $event)
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
            @endforeach
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
<script>
    import EventTable from "../../js/components/event-table";
    export default {
        components: {EventTable}
    }
</script>
<script>
    import ButtonCounter from "../../js/components/button-counter";
    export default {
        components: {ButtonCounter}
    }
</script>
<script>
    import ButtonCounter from "../../js/components/button-counter";
    export default {
        components: {ButtonCounter}
    }
</script>
<script>
    import EventTable from "../../js/components/event-table";
    export default {
        components: {EventTable}
    }
</script>
<script>
    import EventTable from "../../js/components/event-table";
    export default {
        components: {EventTable}
    }
</script>
