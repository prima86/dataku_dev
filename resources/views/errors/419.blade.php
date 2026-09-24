@extends('errors.main_error')
@section('content')
	@php
		$telegram_message = "<b>[DataKu]</b> \n\n<b>Error(419) </b> \n<a href='".url()->current()."'>".url()->current()."</a>";
		if( $exception->getMessage() ){
			$telegram_message .= "\n\n<b>Message</b> : \n".$exception->getMessage();
		}
		$telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];
		telegram_notification($telegram_message,'force');
	@endphp
	<h1 class="number text-center">419</h1>
	<h2 class="description text-center">
		@if( $exception->getMessage() )
			{{ $exception->getMessage() }}
		@else
			The page has expired due to inactivity.
		@endif
	</h2>
@endsection
