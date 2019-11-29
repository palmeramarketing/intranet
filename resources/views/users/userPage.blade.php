@extends('layouts.app')

@section('title')
	{{ $user->name }}
@endsection

@section('stylesheet')
@endsection

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<style>
    body
    {
        background-color: #7FB2A5;
    }
    .modal-backdrop {
        z-index: -3;
    }
</style>
<div class="page-header text-center">
    <div class="card col-md-2 col-10 mr-auto ml-auto" style="display: inline-block; margin: 0px; height: 300px;">   
        
    	<div class="card-body">
    		<h4 class="card-text h4 text-uppercase">{{ $user->name }}</h4>
            <span class="h4 text-uppercase">{{ $user->last_name }}</span>
            <span class="h6 text-uppercase py-2">{{ $user->email }}</span>
            @foreach($departments as $department)
    	                		
    			@if($user->department == $department->id)
        			<div class="py-5">
        				<span class="card-text text.muted h4 text-uppercase py-5">
                			{{ $department->name }}
                		</span>
                	</div>
    			@else
    			@endif
    	    @endforeach
            
    	</div>
    	<div class="card-footer" style="position: absolute; bottom: 0px; left: 15%;">
    	 	<span>{{ $user->created_at}}</span>
    	</div>
    </div>
</div>

@endsection

@section('script')

@endsection