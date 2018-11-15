<?php

namespace App\Http\Controllers;
//use Crypt;
use cache;
use store;
//use Memcached;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use PhpApi\PhpApi\PhpApi;
use Illuminate\Filesystem\Filesystem;
use Excel;
use Schema;
use DB;

class MangerController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {


    }

    /*
     * 管理后台方法
     */
    public function Manger(){
      return view('Manger');
    }

//  美拍 跟抱抱


//    //注册
//    public function Register(){
//        return view('register');
//    }
//    public function Register1(){
//        var_dump($_POST);
//       // return view('register');
//    }

    //登陆
    public function Login(){

    }
    /*
     * 处理excel文件
     */
     public function  Setexcel(Request $request){

         if ($_FILES["file"]["error"] > 0)
         {
             echo "Error: " . $_FILES["file"]["error"] . "<br />";
         }
         else
         {
             echo "Upload: " . $_FILES["file"]["name"] . "<br />";
             echo "Type: " . $_FILES["file"]["type"] . "<br />";
             echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
             echo "Stored in: " . $_FILES["file"]["tmp_name"];
             echo "<br/>";
         }
         $destinationPath = 'uploadFiles/Excel/';
         $tabl_name = date('YmdHis').mt_rand(100,999);
         $newName = $tabl_name.'.'.'xls';//$entension;
      //   echo $destinationPath;
      //   Storage::putFile('photos', new File('/public'));
         $filepath = $request->file('file')->move($destinationPath,$newName);
       //  $filepath = $destinationPath.'a.xlsx';
         Excel::load($filepath, function($reader) {
             $data = $reader->all();
             //dd($data);
             var_dump($data);
         });

     }




    public function Excel(){
        $destinationPath = 'uploadFiles/Excel/';
        $filepath = $destinationPath."2.xls";
        Excel::load($filepath, function($reader) {
           // $data = $reader->all();
            $tabl_name = date('YmdHis').mt_rand(100,999);
            $reader = $reader->getSheet(0);
            $data = $reader->toArray();

            $result = $this->create_table($tabl_name,$data);
            //dd($result);
            //var_dump($data);
        });

    }


    public function create_table($table_name,$arr_field)
    {

        $tmp = $table_name;
        $va = $arr_field;
        /*
         * 创建数据表
         */
//        Schema::create('tasks2', function($table)use($va){
//            $fields = $va[0];  //列字段
//            $fileds_count =  0; //列数
//                        foreach($fields as $key => $value){
//                if($key == 0){
//                    $table->string($fields[$key]);//->unique(); 唯一
//                }else{
//                    $table->string($fields[$key]);
//                }
//                $fileds_count = $fileds_count + 1;
//            }
//        });
        /*
         * 将excel表加载到数据库
         */
        $value_str="";
        foreach($va as $key => $value){
            if($key!=0){
                foreach ( $value as $key => $val ) {
                    $value_str .= "'$val',";

                }
               $news = rtrim($value_str, ",");
             $result = DB::insert("insert into manager_users values ($news)");
            }
            $value_str="";
        }
        if($result){
            return  1;
        }
//        return 1;
    }



    //日上播时间最长主播
    public function daylongStar(){
         //DB::select("select * from live_log WHERE  ");
    }

    /*
     * 当前在线主播最高排行（榜）
     */
    public function topOnline(){
        $api = new  PhpApi();
        //查询是否有查询

        $result  =   $api->Returndata('topOnline');
         return $result;
    }

/*
 * 检查  是否登录
 */
  public function checklogin(){
   //***code
  }

    public function star(){
         //主播
    }

}


