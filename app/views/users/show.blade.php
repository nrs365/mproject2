@extends('layouts.master')

@section('content')
 <div class="container">
        <div class="row"> 
            @if(Auth::user())
                    @foreach ($clients as $client)
                    <div class="">
                        <ul>
                            <li>{{$client->company_name}}</li>
                        </ul>
                    </div>
                    @endforeach
                @endif 
    </div>
</div>              

@stop