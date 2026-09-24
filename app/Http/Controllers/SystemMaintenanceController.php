<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\Filesystem;
use File;
use Ifsnop\Mysqldump as IMysqldump;
use Zipper;
use Mail;
use Storage;

class SystemMaintenanceController extends Controller
{
  public function __construct()
  {
      // $this->middleware('auth');
  }

  // public function index()
  // {
  //   return view('home');
  // }
  public static function phpInfo()
  {
    phpinfo();
  }

  public static function backup($backup_token)
  {
    ini_set('memory_limit','1024M');
    if($backup_token == env('SYSTEM_MAINTENANCE_TOKEN')){
      $date       = date("Y_m_d__ H_i_s");
      $date_human = date("l d F Y H:i:s");
      $name       = 'dataku__'.$date;
      $file_name  = 'storage/backup/temp/dataku__'.$date.'.sql';
      $zip_filename = 'storage/backup/dataku__'.$date.'.zip';
      $progress_status  = [];

      try {
        $dump = new IMysqldump\Mysqldump('mysql:host='.env('DB_HOST').';dbname='.env('DB_DATABASE'), env('DB_USERNAME'), env('DB_PASSWORD'));

        File::deleteDirectory('storage/backup');
        File::makeDirectory('storage/backup/temp/', 0777, true, true);

        $dump->start($file_name);

        $progress_status['sql_dump'] = "<b>- MySQL dump :</b> Successfull";
      } catch (\Exception $e) {
        // echo 'Something went wrong: ' . $e->getMessage();
        $progress_status['sql_dump'] = "<b>- MySQL dump :</b> ".$e->getMessage();
      }

      try {
        Zipper::make($zip_filename)->folder('public/images/')->add('public/images')->close();
        Zipper::zip($zip_filename)->folder('sql')->add($file_name)->close();

        $progress_status['zipping_files'] = "<b>- Compressing Files :</b> Successfull";

      } catch (\Exception $e) {
        // echo 'Something went wrong: ' . $e->getMessage();
        $progress_status['zipping_files'] = "<b>- Compressing Files :</b> ".$e->getMessage();
      }

      try {
        // Mail::raw('Successfull Backup Created at '.$date, function($message) use ($zip_filename) {
        //    $message->subject('Dataku System Backup');
        //    $message->attach($zip_filename);
        //    $message->to('thariq.akbar.tuhuwikan@gmail.com');
        // });

        $filename = $name.'.zip';
        $filePath = $zip_filename;
        $fileData = File::get($filePath);
        Storage::cloud()->put($filename, $fileData);
        $progress_status['send_backup'] = "<b>- Back Up Google Drive :</b> Successfull";

      } catch (\Exception $e) {
        // echo 'Something went wrong: ' . $e->getMessage();
        $progress_status['send_backup'] = "<b>- Back Up Google Drive :</b> ".$e->getMessage();
      }

      // $telegram_message = "<b>[DataKu]</b> \n\n<b>Backup Report </b> \n".url()->current();
      $telegram_message = "<b>[DataKu]</b> \n\n";
      $backup_mesagges  = implode("\n", $progress_status);

      $telegram_message .= "<b>Backup Report :</b> \nBackup Progress at ".$date_human."\n".$backup_mesagges;
			$telegram_message .= "\n\n<b>User Agents</b> : \n".$_SERVER['HTTP_USER_AGENT'];

			telegram_notification($telegram_message);
      // echo json_encode($progress_status);
    }else{
      abort(404);
    }
  }

  public function telegram_pull($backup_token){
    if($backup_token == env('SYSTEM_MAINTENANCE_TOKEN')){
      function request_url($method)
      {
        $token = '702896081:AAGiSCZftSB_UND1UqbIdNI-etWfGt1KJGM';
      	// global $token;
      	return "https://api.telegram.org/bot" . $token . "/". $method;
      }

      function get_updates($offset)
      {
      	$url = request_url("getUpdates")."?offset=".$offset;
              $resp = file_get_contents($url);
              $result = json_decode($resp, true);
              if ($result["ok"]==1)
                  return $result["result"];
              return array();
      }

      function send_reply($chatid, $msgid, $text)
      {
          $data = array(
              'chat_id' => $chatid,
              'text'  => $text,
              'reply_to_message_id' => $msgid

          );
          // use key 'http' even if you send the request to https://...
          $options = array(
          	'http' => array(
              	'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
              	'method'  => 'POST',
              	'content' => http_build_query($data),
          	),
          );
          $context  = stream_context_create($options);

          if($text){
            $result = file_get_contents(request_url('sendMessage'), false, $context);
            print_r($result);
          }
      }

      function create_response($text)
      {
         // return "definisi " . $text;
      	 // if($text == '/hi'){
      		//  return 'Hi there, Can I help You?';
      	 // }
      	switch ($text) {
      		case '/hi':
      		  return 'At Your Service. See /command_list for accessing command.';
      		  break;
      		case '/command_list':
            $command_list = ['','hi','command_list','how_are_you','server_status','who_are_you','backup_dataku'];
            $command_list = implode(" \n /",$command_list);
      		  return $command_list;
      		  break;
      		case '/how_are_you':
      		  return 'everything is OK.';
      		  break;
      		case '/server_status':
      		  return 'Server is running.';
      		  break;
      		case '/who_are_you':
      		  return 'I am a bot created by thariq akbar tuhuwikan. Ready to serve.';
      		  break;
      		case '/backup_dataku':
      			// $response = file_get_contents('http://localhost/dataku/dev/system_maintenance/backup/fd65f51e96e853c035f33fb3f55cd0dc');
      			// return 'Backup Complete : '.$response;
            SystemMaintenanceController::backup(env('SYSTEM_MAINTENANCE_TOKEN'));
      			return 'Manual Backup Complete.';
      		  break;
      	// default:
      	//  	return 'unknown command';
      	}
      }


      function process_message($message)
      {
          $updateid = $message["update_id"];
          $message_data = $message["message"];
          if (isset($message_data["text"])) {
      	$chatid = $message_data["chat"]["id"];
              $message_id = $message_data["message_id"];
              $text = $message_data["text"];
              $response = create_response($text);
              send_reply($chatid, $message_id, $response);
          }
          return $updateid;
      }


      function process_one()
      {
      	$update_id  = 0;

      	if (file_exists("storage/telegram_bot/last_update_id")) {
      		$update_id = (int)file_get_contents("storage/telegram_bot/last_update_id");
      	}

      	$updates = get_updates($update_id);

      	foreach ($updates as $message)
      	{
           		$update_id = process_message($message);
      	}
      	file_put_contents("storage/telegram_bot/last_update_id", $update_id + 1);

      }

      while (true) {
        if(date("H:i:s") >= '22:30:00'){
          exit();
        }else{
          process_one();
        }
      }
      // process_one();
    }else{
      abort(404);
    }

  }

}
