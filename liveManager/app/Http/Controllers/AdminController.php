<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 2016/12/14
 * Time: 15:43
 */
namespace App\Http\Controllers;
use Excel;
use DB;
use Illuminate\Http\Request;
use PhpApi\PhpApi\PhpApi;
class AdminController extends BaseController
{

 
          function test(){
/*
 *     
 *     假如有报错，返回 调用Common::getErrorMsg（错误代码）的返回结果
 *     没有报错，直接调用api里面的函数，返回  逻辑处理返回的值  赋值给数组的 data    
 * 判断code   
 * 

 */
              print_r($this -> input);

              echo $this -> input -> id;

              $data = PhpApi::users($this -> input);

              //在controlleru有错误时
              //return parent::getError(10000);

              return parent::getError($data);


          }

        /*
         * 月收入趋势
         */
    public function companyIncome(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::companyIncome($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }


        /*
         * 月达标主播
         */
    public function monthStarate(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::monthStarate($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }   //starManager

    /*
 * 主播考勤单数
 */
    public function starManager(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::starManager($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }   //starManager

    /*
* 主播考勤单数
*/
    public function livehistry(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::livehistry($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }   //starManager


    /*
* 主播考勤单数
*/
    public function starLiveState(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::starLiveState($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }   //starManager








    /*
 * 月达标主播
 */
    public function menu(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::menu($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }


      /*
         * 月未达标主播      menu
         */
    public function monthStarunrate(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::monthStarunrate($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     * 日考勤单数
     */
    public function pageWork(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pageWork($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
   * 月考勤单数
   */
    public function pagemonthWork(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pagemonthWork($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
     * 主播详情
     */
    public function starDetail(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::starDetail($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
 * 主播直播记录
 */
    public function livehistrys(){      //livehistrys
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::livehistrys($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }




    /*
     * 月粉丝趋势
     */
    public function companyFollower(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::companyFollower($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    
   /*
    * 当前在线观看人数最高排行
    */
    public function topOnline(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::topOnline($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     *日收入最高的主播
     */
    public function topIncome(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::topIncome($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
   *日粉丝最高的主播
   */
    public function topFans(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::topFans($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
     * 今日总览 单数
     */
    public function pageIndex(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pageIndex($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     * 日上播时间最长时间
     */
    public function TopLivetime(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::TopLivetime($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

 /*
 * 平台增粉榜
 */
    public function pageFllower_plat(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pagePlatfollower($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }  //liveUrl
    /*
     * 直播链接地址
     */
    public function liveUrl(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::liveUrl($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
   /*
    * 平台收入榜
    */
    public function pagePlatincome(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pagePlatincome($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     * 小组收入贡献榜
     */
    public function groupIncome(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::groupIncome($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }  //MongoLiveLog


    /*
   * 主播24小时
   */
    public function MongoLiveLog(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::MongoLiveLog($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }





    /*
     * 小组增粉榜
     */
    public function groupFollower(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::groupFollower($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

     /*
     * 收入分析单数
     */
    public function pageIncome(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pageIncome($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }


     /*
     * 增粉分析单数
     */
    public function pageFollowers(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pageFollowers($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }


    /*
     * 月增粉明细
     */
    public function pageFollower(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::pageFollower($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
   /*
    * 主播管理
    */
    public function filter(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::filter($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     * 主播月粉丝榜 、、monthStarfans
     */
    public function monthStarfans(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::monthStarfans($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
* 月小组考勤
*/
    public function monthWork(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::monthWork($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }



    public function monthDetail(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::monthDetail($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }



    public function search(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::search($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }


    public function noneStars(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::noneStars($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }








    public function Starrate(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::Starrate($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    public function unrateStar(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::unrateStar($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    public function gourps(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::gourps($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
     * 添加经纪人
     */
    public function addAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::addAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
 * 编辑经纪人
 */
    public function editLevel(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::editLevel($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }



    /*
     * 查看所有经纪人
     */
    public function allStar(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::allStar($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
     * 所有经纪人 、、allAgent
     */
    public function allAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::allAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     * 更改经纪人名称
     */
    public function updateAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::updateAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
     * 删除经纪人
     */
    public function deleteAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::deleteAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }


    /*
     * 解约主播
     */
    public function breakStar(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::breakStar($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
     * 所有主播
     */
    public function allStars(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::allStars($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }
    /*
     * 去除经纪人跟主播间的关系
     */
    public function breakAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::breakAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }    //


    /*
  * 查找经纪人旗下主播
  */
    public function searchAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::searchAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }  //

    /*
* 没有经纪人的主播
*/
    public function noneAgent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::noneAgent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
* 所有等级
*/
    public function allLevel(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::allLevel($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }

    /*
* 编辑主播信息
*/
    public function editStar(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::editStar($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }       //


    /*
* 搜索解约的主播
*/
    public function searchBreak(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::searchBreak($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }       //


    /*
* 搜索没有经纪人的主播
*/
    public function searchBreakagent(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::searchBreakagent($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);     //
    }

    /*
* 添加主播
*/
    public function addStar(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::addStar($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);     //
    }
    /*
     * 所有平台
     */
    public function allPlatform(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::allPlatform($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);     //
    }

    /*
 * 添加等级
 */
    public function addLevel(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::addLevel($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);     //
    }

    /*
* 所有等级带翻页
*/
    public function allLevelpage(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::allLevelpage($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);     //       allLevelpage
    }   //
    /*
* 删除等级
*/
    public function deleteLevel(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::deleteLevel($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);     //       allLevelpage
    }   //deleteLevel

    /*
     * 工会月收入趋势
     */
    public function companyrmb(){
        if(!$this -> input){
            return parent::getError(10000);
        }
        if( $this -> input -> token == $this->input->token  ){
            $data = PhpApi::companyrmb($this -> input);
        }else{
            $data =9001;
        }
        return parent::getError($data);
    }



    /*
     *************************************************************************** 主播批量导入
     */
    /*
     * Excel上传
     */
    public function  Setexcel(Request $request){

        if ($_FILES["file"]["error"] > 0)
        {
            echo "Error: " . $_FILES["file"]["error"] . "<br />";
        }
        $destinationPath = 'uploadFiles/Excel/';
        $tabl_name = date('YmdHis').mt_rand(100,999);
        $newName = $tabl_name.'.'.'xls';//$entension;
        //   echo $destinationPath;
        //   Storage::putFile('photos', new File('/public'));
        $filepath = $request->file('file')->move($destinationPath,$newName);
        //  $filepath = $destinationPath.'a.xlsx';
//        Excel::load($filepath, function($reader) {
//            $reader = $reader->getSheet(0);
//            $results = $reader->toArray();
//            dd($results);
//        });

    }
   /*
    * 导入数据库
    */


    public function Excel(){


        $destinationPath = 'uploadFiles/Excel/';
        $filepath = $destinationPath."20161223074328268.xls";
        Excel::load($filepath, function($reader) {
            $value_str="";
            // $data = $reader->all();
            $tabl_name = date('YmdHis').mt_rand(100,999);
            $reader = $reader->getSheet(0);
            $data = $reader->toArray();
//            var_dump($data);
//            echo count($data);
            foreach($data as $key => $value){

                if($key!=0){
                    $this->platForm($value);
//                    foreach ( $value as $key => $val ) {
//                        $value_str .= "'$val',";
//                       /*
//                        * 传值 value 跟 key   ,通过key 跟 value 做处理
//                        */
//
//                        echo $val;
//                        echo $key;
//
//                    }
                    $news = rtrim($value_str, ",");
                  //  var_dump($news);
                  //  $result = DB::insert("insert into manager_users values ($news)");
                }
                $value_str="";
            }

        //    dd($news);

          //  var_dump($data);
//            $result = $this->intoUsers($tabl_name,$data);
//            if($result){
//                return 200;
//            }
        });

    }

      /*
       * 平台
       */

    public function platForm($data){
        $arrpalt="";
        $palt = DB::select("select `name`,`id` from platform");
        foreach ($palt as  $key =>$value){
            $arrpalt[$value->id] = $value->name;
        }
        for ($i =0; $i< count($data); $i++){
            if($i==3){
                var_dump( $data[$i] );
                var_dump($arrpalt);
              var_dump(  array_search($data[$i],$arrpalt) );
              print_r(array_keys($arrpalt,$data[$i]));
            }
           //  var_dump($data[$i]);
        }
//       foreach ($data as $key =>$value){
//           if($key==3){
//
//           }
//       }
        var_dump($data);

    }



}