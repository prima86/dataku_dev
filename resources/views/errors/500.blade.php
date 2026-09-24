@extends('errors.main_error')
@section('content')
		@php
			$telegram_message = "<b>[DataKu]</b> \n\n<b>Error(500) </b> \n<a href='".url()->current()."'>".url()->current()."</a>";
			if( $exception->getMessage() ){
				$telegram_message .= "\n\n<b>Message</b> : \n".$exception->getMessage();
			}

			$telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];

			telegram_notification($telegram_message,'force');
		@endphp
		<h1 class="number text-center">500</h1>
		<h2 class="description text-center">
			Sorry, Something went wrong!
		</h2>
@endsection
