<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016/12/11
 * Time: 14:01
 */

namespace App\Http\Controllers;
use DB;
use PhpApi\PhpApi\PhpApi;
use Illuminate\Support\Facades\MemcachedX;
class RegisterController extends BaseController
{
        public function Register(){
                if(isset($_GET['username'])){
                        echo 1;
                        $username =   $_GET['username'];
                        $password =   md5($_GET['password']."Toubu");
                        $companyid   = $_GET['companyid'];
                        $companyname = $_GET['companyname'];
                        $token       = $_GET['token'];
                        $sql =" insert into `company` (`companyid`,`companyname`,`username`,`password`,`token`)
 values(".$companyid.",'".$companyname."','".$username."','".$password."','".$token ."')";
                       echo $sql;
                        $result = DB::insert(" insert into `company` (`companyid`,`companyname`,`username`,`password`,`token`)
 values(".$companyid.",'".$companyname."','".$username."','".$password."','".$token ."')");


                }else{
                        return view('register');
                }



        }
        public function Login(){

                $getData  = $this -> input;
               $password =$getData->password."Toubu";
               // $password1 ="123456789Toubu";
               $password =  md5($password); 
                
             
                $userid="";
                $result = DB::select("select * from `company` where iphone='".$getData->username."' and password = '".$password."' ");
               if($result){
                $user = $result[0];


                if($user){
                        $this -> input -> token = $user->token;
                        $data['token'] = $user->token;
                        $data['companyId'] =$user->companyid;
                }else{
                    $data =10012;
                }
            }else {
                $data =10025;
            }

                return parent::getError($data);
              //  return false;
              
        }
        public function Loinout()
        {
                $this -> input -> token = "";
//                setcookie("nickname","",0,"/",$_SERVER['SERVER_NAME']);
//                setcookie("userid","",0,"/",$_SERVER['SERVER_NAME']);
//                setcookie("password","",0,"/",$_SERVER['SERVER_NAME']);

        }

        /*
         * 更新bat文件下载
         */
        public     function updateBat(){
               // $PHP_SELF=dirname(__FILE__).'/../../../.bat';

               // echo $PHP_SELF;
              $bat = require_once dirname(__FILE__).'/../../../.bat';
                $res = exec($bat);
                var_dump($res);
        }

      /*
       * 修改密码
       */
    public function Reset(){

        $getData  = $this -> input;

        $password =$getData->password ."Toubu";
        $repassword = $getData->repassword ."Toubu";
        $password =  md5($password);
        $repassword = md5($repassword);

        $result = DB::select("select `password` from `company` where token='".$getData->token."'");
//        var_dump($result);
        if($result){
            if($password ==  $result[0]->password)
            {
//                echo "update  `manager_company` set `password` ='".$repassword  .  "' where token ='".$getData->token."' ";
                 $re = DB::update("update   `company` set `password` ='".$repassword  .  "' where token ='".$getData->token."' ") ;
                if($re){
                   $data =true;
                }
            }else{
                $data = 10027;
            }
        }

        return parent::getError($data);

    }


    /*
     * 重新找回密码
     */

    public function findPassword(){
        $getData  = $this -> input;
        $iphone = $getData->iphone;

//        if(MemcachedX::get($iphone) == $getData->code){

        $re = DB::update("update   `company` set `password` ='".$getData->repassword  .  "' where iphone ='".$getData->iphone."' ") ;
        if($re){
            $data =200; //已经修改成功
        }else{

        }
//        }

    }


  /*
   * 获取验证码
   */
    public function sendRegcode(){


        $getData  = $this -> input;
        $iphone = $getData->iphone;
        $code = mt_rand(1000,9999);
        $data['vercode'] =  $code;
        $data['code'] =200;
        return parent::getError($data);
//        MemcachedX::set($mobile,$code);
//        $cc = MemcachedX::get($mobile);
//        return $mobile."您的验证码为 " .$code;



    }

    /*
     * 配置首页
     */
    public function index(){
        // return
    }


}