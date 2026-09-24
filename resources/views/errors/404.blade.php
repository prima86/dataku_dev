@extends('errors.main_error')
@section('content')
	@php
		$exploded = explode('.',url()->current());
		// if(end($exploded)){
		$exclude	= array('js','css','png','jpg','jpeg','gif','map');
		if (!in_array(end($exploded), $exclude)) {
			$telegram_message = "<b>[DataKu]</b> \n\n<b>Error(404) </b> \n<a href='".url()->current()."'>".url()->current()."</a>";

			if( $exception->getMessage() ){
				$telegram_message .= "\n\n<b>Message</b> : \n".$exception->getMessage();
			}else{
				$telegram_message .= "\n\n<b>Message</b> : \nNot Found, page doesn't exists!";
			}

			$telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];

			telegram_notification($telegram_message,'force');
		}
	@endphp
	<h1 class="number text-center">404</h1>
	<h2 class="description text-center">
		@if( $exception->getMessage() )
			{{ $exception->getMessage() }}
		@else
			Sorry, but this page doesn't exists!
		@endif
	</h2>
@endsection
