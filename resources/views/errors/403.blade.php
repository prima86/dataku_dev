@extends('errors.main_error')
@section('content')
	@php
	// print_array(Session('user_profile'));
		$telegram_message = "<b>[DataKu]</b> \n\n<b>Error(403) </b> \n<a href='".url()->current()."'>".url()->current()."</a>";

		if( $exception->getMessage() ){
			$telegram_message .= "\n\n<b>Message</b> : \n".$exception->getMessage();
		}else{
			$telegram_message .= "\n\n<b>Message</b> : \nClient doesn't have permissions to access this page.";
		}

		if(Session('user_profile')->username){
			$telegram_message .= "\n\n<b>User Profile</b> : ";
			$telegram_message .= "\n<b>Username</b> : ".Session('user_profile')->username;
			$telegram_message .= "\n<b>Name</b> : ".Session('user_profile')->name;
			$telegram_message .= "\n<b>Instansi</b> : ".Session('user_profile')->instansi;
			$telegram_message .= "\n<b>Email</b> : ".Session('user_profile')->email;
		}else{
			$telegram_message .= "\n\n<b>User Profile</b> : ";
			$telegram_message .= "\nGeneral public";
		}

		$telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];

		telegram_notification($telegram_message,'force');
	@endphp
	<h1 class="number text-center">403</h1>
	<h2 class="description text-center">
		@if( $exception->getMessage() )
			{{ $exception->getMessage() }}
		@else
			You don't have permissions to access this page.
		@endif
	</h2>
@endsection
