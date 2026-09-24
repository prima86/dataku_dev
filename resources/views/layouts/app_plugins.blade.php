@php
	foreach ($app_plugins as $app_plugins) {
		$file = File::allFiles(public_path('app_plugins/').$app_plugins);

		// $file = File::allFiles(config('dataku.app_plugins_path').$app_plugins);  //script aslinya ini

		// dd($file);
		
		foreach ($file as $file) {

			//$tes[] = $file->getPathname();			

			if($file->getExtension() == 'css'){

				//dd(json_encode($file->getPathname()));

				$stylesheet[] = '<link rel="stylesheet" href="'. asset(str_replace('C:\xampp\htdocs\dataku\public\app_plugins', 'app_plugins', $file->getPathname())) .'">';

				
				//dd($stylesheet);
				//foreach($stylesheet as $a) {
				//	echo $a;
				//	echo '<br/>';
				//}
				
				//$new_getPathname = substr($file->getPathname(), 30);
				//dd($new_getPathname);
				//echo "<br/>";


			}elseif($file->getExtension() == 'js'){
				if (strpos($app_plugins, 'system/') !== false) {

					//echo $app_plugins;

					$new_full_path = str_replace('.js','.min.js',str_replace('system/','system_minified/',str_replace('\\', '/',$file->getPathname())));

					//dd($new_full_path);

					if (!file_exists($new_full_path)) {
						//dd('file tidak ada');
						$file_name = explode('/',$new_full_path);
						$file_name = end($file_name);

						//dd($file_name);

						$new_directory	= str_replace($file_name,'',$new_full_path);


						//dd($new_directory);

				    // $new_directory  = config('dataku.app_plugins_path').'system_minified/statistik_sektoral/dss_2_1/';
				    mkdir($new_directory, 0777, true);
						$minifier = new Minifier($file->getPathname());
				    $minifier->minify($new_directory.$file_name);
						// echo $minifier->minify();
		    	}
					if(env('JS_MINIFIER') == 'true'){
						$new_full_path2 = str_replace('C:/xampp/htdocs/dataku/public', '', $new_full_path);

						//dd($new_full_path2);

						$script[] = '<script type="text/javascript" src="'.asset($new_full_path2).'"></script>';

						//dd($script);

					}else{
						$script[] = '<script type="text/javascript" src="'.asset(str_replace('\\', '/',$file->getPathname())).'"></script>';

					}
				}else{
					$script[] = '<script type="text/javascript" src="'.asset(substr($file->getPathname(), 30)).'"></script>';
				}
			}
		}
	}
@endphp

@section('header')
	@if(!empty(@$stylesheet))
		@foreach ($stylesheet as $stylesheet)
			{!! $stylesheet !!}
		@endforeach
	@endif
@endsection

@section('custom_script')
	@if(!empty(@$script))
		@foreach ($script as $script)
			{!! $script !!}
		@endforeach
	@endif
@endsection
