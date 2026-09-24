<?php
/*----------------------print formated variable---------------------------*/
if ( ! function_exists('print_array')){
	function print_array($array_data, $comment='') {
		if($array_data) {
			echo '<pre>';

			if ($comment) echo '# ' . $comment . "\n";
			echo '--------------------------------'. "\n";
			print_r($array_data);
			echo "\n--------------------------------";
			echo '</pre>';
		}
	}
}


/*---------------------- RANDOM BACKGROUND---------------------------*/
if ( ! function_exists('display_background')){
	function display_background()
	{
		$dir = public_path('dataku/images/background/');
		//$dir = 'public/dataku/images/background/';    //ini script aslinya
		$cnt = 0;
		$bgArray= array();

				/*if we can load the directory*/
		if ($handle = opendir($dir)) {

			/* Loop through the directory here */
			while (false !== ($entry = readdir($handle))) {

			$pathToFile = $dir.$entry;
			if(is_file($pathToFile)) //if the files exists
			{
				//make sure the file is an image...there might be a better way to do this
				if(getimagesize($pathToFile)!=FALSE)
				{
					//add it to the array
					$bgArray[$cnt]= $pathToFile;
					$cnt = $cnt+1;

				}

			}

		}
		//create a random number, then use the image whos key matches the number
		$myRand = rand(0,($cnt-1));
		$val = $bgArray[$myRand];

		}
		closedir($handle);
		return ($val);

	}
}

/*----------------------validate if filed not empty---------------------------*/
if ( ! function_exists('validate_if_exist')){
	function validate_if_exist($input,$rules) {
		if(!empty($input) && !empty($rules)) {
			return $rules;
		}else{
			return '';
		}
	}
}

/*----------------------if file is image---------------------------*/
if ( ! function_exists('is_image')){
	function is_image($input) {
		$image_info = @getimagesize($input);
		if($image_info == false) {
			return false;
		 } else {
			return true;
		 }
	}
}

/*----------------------get avatar---------------------------*/
if ( ! function_exists('get_avatar')){
	function get_avatar($input) {
		if(is_image(asset('images/avatars/').$input)){
			return asset('images/avatars/').$input;
		}else{
			return asset('images/avatars/avatar.jpg');
		}
	}
}

/*-------------------------- FUNCTION INA DATE ----------------------*/
if ( ! function_exists('ina_date')){
	function ina_date($date=FALSE,$day=FALSE){
		if($date){
			$exploded 		= explode(' ',$date);

			if(!empty($exploded['1'])){
				$time = $exploded['1'];
			}else{
				$time = '';
			}

			if(!empty($exploded['0'])  && $exploded['0'] != '0000-00-00'){
				$extractdate 	= explode('-', $exploded['0']);

				$arrdate = array('','Januari','Februari','Maret','April','Mei','Juni','Juli',
								'Agustus','September','Oktober','November','Desember');

				$month= $arrdate[$extractdate[1]+0];
				if(strlen($extractdate[0]) == 2 ){
					$newdatetime = $extractdate[0].' '.$month.' '.$extractdate[2].' '.$time;
				}else{
					$newdatetime = $extractdate[2].' '.$month.' '.$extractdate[0].' '.$time;
				}
			}else{
				$newdatetime = '';
			}
			if(!empty($day)){
				$day 		= date('D',strtotime($exploded['0']));
				$day_list 	= array('Sun' => 'Minggu','Mon' => 'Senin','Tue' => 'Selasa','Wed' => 'Rabu',
								'Thu' => 'Kamis','Fri' => 'Jumat','Sat' => 'Sabtu');
				$day 		= $day_list[$day];
				$newdatetime = $day.', '.$newdatetime;
			}

		}else{
			$newdatetime = '';
		}
		return $newdatetime;
	}
}

/*----------------------- FUNCTION INA SHORT DATE ---------------------*/
if ( ! function_exists('ina_short_date')){
	function ina_short_date($date=FALSE){
		if($date){
			$exploded = explode(' ',$date);

			if(!empty($exploded['1'])){
				$time = ' '.$exploded['1'];
			}else{
				$time = '';
			}

			$extractdate = explode('-', $exploded['0']);
			if(!empty($date)){
				if(strlen($extractdate[0]) == 2 ){
					$newdate 		= $extractdate[0].'-'.$extractdate[1].'-'.$extractdate[2];
					$newdatetime 	= $extractdate[0].'-'.$extractdate[1].'-'.$extractdate[2].' '.$time;
				}else{
					$newdate 		= $extractdate[2].'-'.$extractdate[1].'-'.$extractdate[0];
					$newdatetime 	= $extractdate[2].'-'.$extractdate[1].'-'.$extractdate[0].' '.$time;
				}
				if($newdate == '00-00-0000'){
					$newdatetime 	= '';
				}
			}
		}else{
			$newdatetime = '';
		}
		return $newdatetime;
	}
}

/*--------------------------------------- FUNCTION SQL DATE FORMAT -------------------------------------*/
if ( ! function_exists('to_sql_date')){
	function to_sql_date($date){
		if($date){
			$exploded = explode(' ',$date);

			if(!empty($exploded['1'])){
				$time = ' '.$exploded['1'];
			}else{
				$time = '';
			}

			$extractdate = explode('-', $exploded['0']);
			if(!empty($date)){
				if(strlen($extractdate[0]) > 2 ){
					$newdatetime = $extractdate[0].'-'.$extractdate[1].'-'.$extractdate[2].' '.$time;
				}else{
					$newdatetime = $extractdate[2].'-'.$extractdate[1].'-'.$extractdate[0].' '.$time;
				}
			}
		}else{
			$newdatetime = '';
		}
		return $newdatetime;
	}
}
/*--------------------------------------- FUNCTION GET STATUS DSS TOC -------------------------------------*/
if ( ! function_exists('get_dss_toc_status')){
	function get_dss_toc_status($input){
		if($input){
			switch ($input) {
				case '':
					$result['text'] = 'empty';
					$result['style'] = 'secondary';
					break;
				case '1':
					$result['text'] = 'verification';
					$result['style'] = 'warning text-white';
					break;
				case '2':
					$result['text'] = 'publish';
					$result['style'] = 'success';
					break;

				default:
				$result['text'] = 'empty';
				$result['style'] = 'secondary';
					break;
			}
		}else{
			$result['text'] = 'empty';
			$result['style'] = 'secondary';
		}
		return $result;
	}
}

/*--------------------------------------- FUNCTION SET EMPTY IF 0 -------------------------------------*/
if ( ! function_exists('zero_to_empty')){
	function zero_to_empty($input){
		if($input == 0){
			$input = '';
		}
		return $input;
	}
}

/*--------------------showa avatar -------------------------*/
if ( ! function_exists('show_avatar')){
	function show_avatar($mediapath){
		if (is_image($mediapath)){
			return $mediapath;
		}else{
			return Config::get('dataku.avatar_default');
		}
	}
}

/*--------------------check dss privilege-------------------------*/
if ( ! function_exists('check_dss_privilege')){
	function check_dss_privilege($id_instansi,$status){
		if(@$id_instansi == @session('user_profile')->id_instansi || @session('user_profile')->user_type == 'admin' || $status == 2){
      return TRUE;
    }else{
      return FALSE;
    }
	}
}

/*--------------------Telegram Notifications-------------------------*/
if ( ! function_exists('telegram_notification')){
	function telegram_notification($message='system notifcation',$mode=false){
		if(env('TELEGRAM_NOTIFICATION') == true || $mode == 'force'){
			$message .= get_ip_detail();
			$apiToken = "702896081:AAGiSCZftSB_UND1UqbIdNI-etWfGt1KJGM";
			if (strpos($message, 'Telegram Messenger') === false) {
				$data = [
					'chat_id' => '-316598643',
					'text' => $message
				];
				$response = @file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?".http_build_query($data)."&parse_mode=html" );

				if ( strpos(url()->current(), 'dss/') === false || strpos($message, 'Error(') !== false ){
					$data = [
						'chat_id' => '-267843274',
						'text' => $message
					];
					$response = @file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?".http_build_query($data)."&parse_mode=html" );
				}
			}else{
				$response = 'Access from Telegram Messenger Network';
			}
			return $response;
		}
	}
}

/*--------------------Get Visitor Detail-------------------------*/
if ( ! function_exists('get_ip_detail')){
	function get_ip_detail($ip=FALSE){
		if($ip == FALSE){
			$ip = $_SERVER['REMOTE_ADDR']; // the IP address to query
		}
		$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
		$visitor = "\n\n<b>Visitor Detail</b>";
		if($query && $query['status'] == 'success') {
			if($query['query']){
				$visitor .= "\n<b>IP Address :</b>".$query['query'];
			}if($query['country']){
				$visitor .= "\n<b>Country :</b>".$query['country'];
			}if($query['regionName']){
				$visitor .= "\n<b>Region Name :</b>".$query['regionName'];
			}if($query['city']){
				$visitor .= "\n<b>City :</b>".$query['city'];
			}if($query['isp']){
				$visitor .= "\n<b>ISP :</b>".$query['isp'];
			}if($query['org']){
				$visitor .= "\n<b>Organization :</b>".$query['org'];
			}if($query['lat']){
				$visitor .= "\n<b>Latitude :</b>".$query['lat'];
			}if($query['lon']){
				$visitor .= "\n<b>Longtitude :</b>".$query['lon'];
			}
		} else {
			$visitor .= "\nUnable to get visitor details";
		}

		return $visitor;
	}
}



?>
