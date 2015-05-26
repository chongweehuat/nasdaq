<?php namespace App;
use Illuminate\Database\Eloquent\Model;

use DB;

class Import extends Model {

	public static function data(){
		set_time_limit(0);
		$time_start=time();
		$adir=scandir('data');
		foreach($adir as $k=>$fn){
			if(substr($fn,-4)=='.txt'){				
				$data=file_get_contents('data/'.$fn);
				$adata=explode(chr(13).chr(10),$data);

				foreach($adata as $l=>$d){
					$a=explode(',',$d);

					if(count($a)>1){

						DB::table('ztrade')->insert([
						'code'=>$a[0],
						'date'=>substr($a[1],0,4).'-'.substr($a[1],4,2).'-'.substr($a[1],6,2),
						'open'=>$a[2],
						'high'=>$a[3],
						'low'=>$a[4],
						'close'=>$a[5],
						'volume'=>$a[6],
						]);

					}
				}				

			}

		}
		$time_lapse=time()-$time_start;
		return $time_lapse;	
	}
}