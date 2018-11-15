<?php

namespace App\Http\Controllers;
use FastRoute\Dispatcher;
use Illuminate\Http\Request;
use PhpApi\PhpApi\helpers;
class BaseController extends Controller
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
     * 权限检查
     * 
     * 区分权限检查（star）
     *
     * code  controller返回错误提示/api返回错误提示
     */

    /**
     * 获取当前控制器名
     *
     * @return string
     */
    public function getCurrentControllerName()
    {
        return getCurrentAction()['controller'];
    }

    /**
     * 获取当前方法名
     *
     * @return string
     */
    public function getCurrentMethodName()
    {
        return getCurrentAction()['method'];
    }

    /**
     * 获取当前控制器与方法
     *
     * @return array
     */
    public function getCurrentAction()
    {
        $name = route_parameter('name');
        var_dump($name);

    }



}