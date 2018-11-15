<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
//use Request;
//use FastRoute\Dispatcher;
//use Illuminate\Http\Response;
use Illuminate\Support\Facades\Common;
use Illuminate\Support\Facades\Route;
class BaseController extends Controller
{

    public $currentUser = 0;
    public $currentAction = "";
    public $input;

    protected $actions = "updateBat,postRegister,Login,Register,Setexcel,Excel,Reset,companyIncome";


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        //检测该方法是否需要验证
         header("P3P: CP=CURa ADMa DEVa PSAo PSDo OUR BUS UNI PUR INT DEM STA PRE COM NAV OTC NOI DSP COR");

        header("Access-Control-Allow-Origin: *");

        $this -> getInput();

        $this->getCurrentAction($request);

        $auth = $this -> passAuthor();

        if($auth["code"] != 200){
            echo json_encode($auth);
            die();
        }


    }
    /*
     * 权限检查
     * 
     * 区分权限检查（star）
     *
     * code  controller返回错误提示/api返回错误提示
     */

    public function getInput(){
//        $header = getallheaders();
//      echo  Common::getHeader($header);
        $json = "";

        if(file_get_contents("php://input") !==""){
            
            $json = file_get_contents("php://input");
            
            $json = urldecode($json);
        }else if(isset($GLOBALS['HTTP_RAW_POST_DATA'])==true && $GLOBALS['HTTP_RAW_POST_DATA'] != ""){

            $json = $GLOBALS['HTTP_RAW_POST_DATA'];
            $json = urldecode($json);
        }elseif(isset($_SERVER["QUERY_STRING"])==true && $_SERVER["QUERY_STRING"] != ""){

            $json = $_SERVER["QUERY_STRING"];
            $json = urldecode($json);
        }else{
            $json = "{}";
        }


        $this -> input = json_decode($json);

    }

    /*
     * 检查是否有权限访问
     */
    public function passAuthor(){
            /*
             *  $arr = (排除掉不需要验证的函数);
             * if(当前访问的方法 == $arr[]   ) ? 不需要进行登陆验证  ::需要进行验证
             * 不需要进行登陆验证   ： 返回为ture，允许访问
             * 需要进行验证         :   判断是否登陆
             * if(没有登陆)  调用错误提示  提醒用户用户登陆
             * if(已经登陆)          : 返回为ture   允许访问
             *
             */
      // $Method = $this->getCurrentAction(); //获取当前方法名
     //  $Method =__FUNCTION__;       //
      //  dd( $Method);
        $arr = explode(",",$this -> actions);

        // $arr = (排除掉不需要验证的函数);
        //dd($this -> input);
        if(in_array($this -> currentAction,$arr)){
              //不需要进行验证
            return $this->getError(200);
        }else{
            if(isset($this -> input -> token)){
                 //已经登陆
                $this -> input -> currentUser = 100;
                return $this->getError(200);
            }else{
                //调用错误提示
             return $this->getError(10001);
                
            }
        }

    }

//    /*
//     * 返回错误提示
//     */
//    public function errorCode($code,$msg){
//          /*
//           * $arr[code]  = 返回错误的代码
//           * $arr[msg]   = 错误提示
//           * 返回 arr数组
//           */
//        $cars=array("Volvo","BMW","Toyota");
//        var_dump($cars);
//    }





    /**
     * 获取当前控制器与方法
     *
     * @return array
     */
    public function getCurrentAction(Request $request)
    {
        $routeInfo =  $request->route();

        $rule ='/\@(.*)$/';
        preg_match($rule,$routeInfo[1]['uses'],$actionname);

        $this -> currentAction = $actionname[1];

    }


    /*
  * 建立一个封装数据的方法
     * 传值 code ，data =null
  * 新建一个数组   data,err,msg
  * 传code 过去，返回msg，
  */

    public function getError($data){

        if(is_numeric($data)){
            $data1 =$data;
            $data = new \stdClass();
            $data -> code = $data1;
        }

        $result = array();

        if(isset($data -> code)){
            $result["code"] = $data -> code;
            $result["msg"] = Common::getErrorMsg($data -> code);
            $result["data"] = "";
        }else{

            $result["code"] = 200;
            $result["msg"] =  "";
            $result["data"] = $data;
        }

        return $result;
    }



}