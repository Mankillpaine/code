<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\MemcachedX;
use Laravel\Lumen\Routing\Controller as BaseController;
use DB;

class LoginController extends Controller
{
	
    
	public function __construct(){
		header("Content-type:text/html;charset=utf-8");
	}



	
	//登录页面
	public function login(Request $request){


		if(isset($_POST["mobile"])){
			
			//提交状态，链接数据库检查是否正常
			$mobile = $_POST["mobile"];
			$password = md5($_POST["password"]."ToubU");

			$result = DB::select("select * from tool_users where mobile='".$mobile."' and password='".$password."'");
			if(count($result) == 1){
				$this->loginuser($result[0]->id);

				echo "<script>alert('登录成功'); location.href='zbindex';  </script>";
			}else{
				echo "<script>alert('登录失败');  </script>";

				return view('zhlogin');
			}
			
		}else{
			//非提交状态，显示登录界面模板
			return view('zhlogin');
		}


			
	}


	
	//注册页面
	public function register(Request $request){

		if(isset($_POST["mobile"])){
			
			//提交状态，链接数据库检查是否正常
			$mobile = $_POST["mobile"];
			$password = md5($_POST["password"]."ToubU");
			$code = $_POST["code"];
			
			$codex = MemcachedX::get($mobile);
			
			if($codex == $code){
				//短信验证成功，写入数据

				try{
                	$id = DB::table('tool_users')->insertGetId(array('mobile' => $mobile, 'password' => $password));
					
					print_r(DB::getQueryLog());
				}
				catch(Exception $ex){
					print_r($ex);
				}
				catch (Throwable $e) {

					print_r($e);
				}
				
				print_r($id);
				
                if(isset($id) && $id != ""){
					
                    $this -> loginuser($id);
                    echo "<script>alert('注册成功！');  location.href='zbindex';  </script>";
					
					//显示注册成功提示，继续跳转到下一页
					//echo "<script>alert('恭喜您，注册成功！请完善您的主播信息哦');  </script>";

                }else{
                    echo "注册失败,请联系管理员";
                }

				

			}else{
				//短信验证失败，显示失败提示

				echo "<script>alert('短信验证码不正确，请重新输入');history.go(-1);</script>";

			}

			
		}else{
			//非提交状态，显示注册界面模板
			return view("zhregister");
		}
	
		
	}
	
	
	public function sendRegcode(Request $request){
		
		$apikey = "79331ab258ab6faa7b9be3cabc891c65";
		$mobile = $_GET["mobile"];
		$code = mt_rand(1000,9999);
		MemcachedX::set($mobile,$code);

		$cc = MemcachedX::get($mobile);



		return $mobile."中间 " .$code ."值 ".$cc;

		$content = "【妈妈会买】您的验证码是".$code.",如非本人操作,请忽略本消息";
		$content=urlencode($content);
		
		$postString="apikey=".$apikey."&text=".$content."&mobile=".$mobile;
		
		$baseUrl = "http://yunpian.com/v1/sms/send.json";

		//echo $baseUrl . "?" . $postString;

		$re = http_post($baseUrl,$postString);
		
		//写入memcached缓存，有效期1小时
//		$memcached -> put($mobile,$code);
		
		echo $re;
	
	}

	//为某用户id登录，写cookie
	function loginuser($userid){

		$result = DB::select("select * from tool_users where id=".$userid);

		$user = $result[0];

		setcookie("nickname",$user->nickname,time()+99999999,"/",$_SERVER['SERVER_NAME']);
		setcookie("userid",$user->id,time()+99999999,"/",$_SERVER['SERVER_NAME']);
		setcookie("password",$user->password,time()+99999999,"/",$_SERVER['SERVER_NAME']);

		return $user;
	}

//为某用户id注销
	function logoutuser(){

		setcookie("nickname","",0,"/",$_SERVER['SERVER_NAME']);
		setcookie("userid","",0,"/",$_SERVER['SERVER_NAME']);
		setcookie("password","",0,"/",$_SERVER['SERVER_NAME']);

	}

	

}
