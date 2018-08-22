@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <contacts v-bind:api-token="'{{ Auth::user()->api_token }}'"></contacts>
        </div>
    </div>
</div>
@endsection
