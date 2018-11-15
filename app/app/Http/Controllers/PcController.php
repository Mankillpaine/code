<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Xxtea;
use Illuminate\Support\Facades\Tbdate;
use Illuminate\Support\Facades\Common;
use PDO;
use DB;
use Cache;
use Memcached;

use Illuminate\Http\Request;
class PcController extends Controller
{

    function wordpress(){
        var_dump($this->yesterdayplatmba());
    }



    /*移动端判断*/
    function isMobile()
    {
        // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
        if (isset ($_SERVER['HTTP_X_WAP_PROFILE']))
        {
            return true;
        }
        // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
        if (isset ($_SERVER['HTTP_VIA']))
        {
            // 找不到为flase,否则为true
            return stristr($_SERVER['HTTP_VIA'], "wap") ? true : false;
        }
        // 脑残法，判断手机发送的客户端标志,兼容性有待提高
        if (isset ($_SERVER['HTTP_USER_AGENT']))
        {
            $clientkeywords = array ('nokia',
                'sony',
                'ericsson',
                'mot',
                'samsung',
                'htc',
                'sgh',
                'lg',
                'sharp',
                'sie-',
                'philips',
                'panasonic',
                'alcatel',
                'lenovo',
                'iphone',
                'ipod',
                'blackberry',
                'meizu',
                'android',
                'netfront',
                'symbian',
                'ucweb',
                'windowsce',
                'palm',
                'operamini',
                'operamobi',
                'openwave',
                'nexusone',
                'cldc',
                'midp',
                'wap',
                'mobile'
            );
            // 从HTTP_USER_AGENT中查找手机浏览器的关键字
            if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT'])))
            {
                return true;
            }
        }
        // 协议法，因为有可能不准确，放到最后判断
        if (isset ($_SERVER['HTTP_ACCEPT']))
        {
            // 如果只支持wml并且不支持html那一定是移动设备
            // 如果支持wml和html但是wml在html之前则是移动设备
            if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') === false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html'))))
            {
                return true;
            }
        }
        return false;
    }

    /*
     * pc首页
     *
     */
    public function toubu(){
        if ($this->isMobile()) {
            // header('Location:http://www.itoubu.com/m/news/');
            return "<script>window.location.href='/m/news/'</script>";
        }
        $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' AND posts.ID IN(SELECT p.post_parent FROM tb_posts as p LEFT JOIN tb_posts  on tb_posts.ID = p.post_parent  WHERE p.post_type ='attachment' and p.post_mime_type = 'image/jpeg' ) ORDER BY posts.ID DESC limit 0,6;
 ");

        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime      =  date("Y-m-d",strtotime("-1 day"));
        }else{
            $endtime      =  date("Y-m-d",strtotime("-2 day"));
        }
        $sql ="SELECT `index` FROM `rank_log` WHERE `platform` =0 AND idate = '".$endtime."'";

        $hyzs = DB::select($sql); //行业指数
        $platmba  = $this->yesterdayplatmba(); //平台指数棒
        $zbmba    = $this->yesterdayhotlist();//主播指数榜
        $thumb = $this->getarticle_thumb();
        $banner = $this->getBanner();// 调用banner图的方法
        return view('toubupc.index')->with('results',$results)->with('banner',$banner)->with('thumb',$thumb)->with('platmba',$platmba)->with('zbmba',$zbmba)->with('hyzs',$hyzs);

    }
    /*
     * 平台和平台名
     */

    public function platname(){
        $platform = DB::select("select `name` from platform");
        $arr = array("code"=>"200","msg"=>"","data"=>$platform);
        return   $arr;
    }

    /*
     * 观察页面
     */
    public function observe(){
      //  $this->weekhot();
//       echo "SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.term_id,term.`name` FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' AND term.term_id =10 ORDER BY posts.ID DESC limit 0,10 ";
//     die;
        //$whyjy  红咖     news 行业资讯  tbrb 头部热榜
        $whyjy = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.term_id,term.`name` FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' AND term.term_id =10 ORDER BY posts.ID DESC limit 0,10 ");
        foreach ($whyjy as $key =>$vaule){
            $vaule->post_content = Common::removeHtml($vaule->post_content );
        }
        $news = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.term_id,term.`name` FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' AND term.term_id =5 ORDER BY posts.ID DESC limit 0,10 ");
        foreach ($news as $key =>$vaule){
            $vaule->post_content = Common::removeHtml($vaule->post_content );
        }
        $tbrb = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.term_id,term.`name` FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' AND term.term_id =9 ORDER BY posts.ID DESC limit 0,10 ");
        foreach ($tbrb as $key =>$vaule){
            $vaule->post_content = Common::removeHtml($vaule->post_content );
        }
        $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' ORDER BY posts.ID DESC limit 0,10 ");
        foreach ($results as $key =>$vaule){
            $vaule->post_content = Common::removeHtml($vaule->post_content );
        }
        foreach ($news as $key =>$vaule){
            $vaule->post_content = Common::removeHtml($vaule->post_content );
        }
        foreach ($tbrb as $key =>$vaule){
            $vaule->post_content = Common::removeHtml($vaule->post_content );
        }
        $thumb = $this->getarticle_thumb();
        $banner = $this->viewbanner();// 调用banner图的方法
        $week  = $this->weekhot();
        $month = $this->monthhot();
        return view('toubupc.observe')->with('banner',$banner)->with('thumb',$thumb)->with('results',$results)->with('whyjy',$whyjy)->with('news',$news)->with('tbrb',$tbrb)->with('weekhot',$week)->with('monthhot',$month);
    }

    /*
     * wp文章详情页
     * 获取文章ID
     * 链接格式     /app/articl_detail?id=20
     */
    public function articl_detail(){
        $id =$_GET['id'];
        if ($this->isMobile()) {
            // header('Location:http://www.itoubu.com/m/news/');
            return "<script>window.location.href='http://www.itoubu.com/m/news/detail/$id'</script>";     // die;
          //  return "<script>window.location.href='/m/news/detail/'.$id.''</script>";
        }

        $update = DB::connection('mysql_center')->update("update  tb_posts set `comment_count` = `comment_count`+1 where ID =".$_GET['id']);
        $id = (int)$_GET['id'];
        $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.ID='".$id."'");
        $relation = $this->relation($id);
        return view('toubupc.observedet')->with('results',$results)->with('relation',$relation);

    }

    /*
     * 相关文章
     */
    public function relation($id){
        $results = DB::connection('mysql_center')->select("SELECT `term`.`term_id`  FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.ID='".$id."'");
        $term_id = $results[0]->term_id;
        $relation_list = DB::connection('mysql_center')->select("SELECT  posts.ID,posts.post_content,posts.post_modified,posts.post_title FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and term.term_id='".$term_id."'  order by posts.comment_count desc limit 5");
        return $relation_list;

    }

      /*
     * 热门城市列表列表
     */
    public function hostlist(){
        $connect = new Memcached;
        $connect->setOption(Memcached::OPT_COMPRESSION, false);
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $connect->addServer('60.205.105.239', 11211);
        $AreasDict   = json_decode($connect->get("AreasDict"));
        $arr1 = array("code"=>"200","msg"=>"","data"=>$AreasDict);
        return   $arr1;    //城市列表


    }

    /*
     * 热门主播列表
     */
    public function authorlist(){
        $connect = new Memcached;
        $connect->setOption(Memcached::OPT_COMPRESSION, false);
        $connect->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        $connect->addServer('60.205.105.239', 11211);
      $AuthorsList = json_decode($connect->get("AuthorsList"));
        $arr = array("code"=>"200","msg"=>"","data"=>$AuthorsList);
        return $arr;    //主播列表


    }




    /*
     * 服务页面
     */
    public function server(){
        return view('toubupc.server');
    }
     /*
      * 指数总榜
      */
    public function rmball(){
        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }else{
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        $platform = DB::select("select * from platform where status =1");
         if(isset($_GET['plat'])){
             $plat = (int)$_GET['plat'];
            $sql = "select * from compositeindex where `groups` = ".$plat." AND idate = '".$endtime."' ORDER by indexnum desc limit 100";
         }else{
              $sql ="select * from compositeindex where `groups` =0 AND idate = '".$endtime."' ORDER by indexnum desc limit 100  ";
         }
        $result = DB::select($sql);

        return view('toubupc.rmball')->with('result',$result)->with('plat',$platform);
    }

   /*
    * 行业指数榜
    *
    */
    public function industryrmb(){
        return view('toubupc.hymba');
    }

    /*
     * 平台指数榜
     */
    public function terracermb(){
        return view('toubupc.terracermb');
    }
    /*
    * 主播详情
    * veri_info 不为空时，为认证的主播
    */
    public function zbdetail(){

        Common::log(time());

        $id =  (int)$_GET['id'];
        $plat = intval($_GET['platformid']);
        $hourse = date("H", time());
        Common::log(time());
        if($hourse>=9) {

            $hostnum = DB::select("select `indexnum` from income_log where platform = " . $id . " and platformid = " . $plat . " and idate =  date_sub(curdate(),interval 1 day)");
        }else{

            $hostnum = DB::select("select `indexnum` from income_log where platform = " . $id . " and platformid = " . $plat . " and idate = date_sub(curdate(),interval 2 day) ");
        }
        Common::log(time());

        if(!$hostnum){
             $hostnum='-';
        }else{
           $hostnum = $hostnum[0]->indexnum;
        }
        Common::log(time());
        $result  = DB::select("select * from users where platform = ".$id. " and platformid = ".$plat."");
        Common::log(time());
        $liveid =  $this->check_lives($id,$plat);
        Common::log(time());
        $ranknum = $this->randplat($plat,$id);
        Common::log(time());
        return view('toubupc.zbdetail')->with('result',$result)->with('hostnum',$hostnum)->with('liveid',$liveid)->with('ranknum',$ranknum);
    }

    public function randplat($platformid,$paltfor){
        $leng = strlen($platformid); //字符串长度
        if($leng>3){
            $num = substr($platformid,strlen($platformid)-3,3); //后三位字符
            if(strlen($paltfor)==1){
                $paltfor = '0'.$paltfor; //平台前面加0
            }
            $men = substr($platformid,0,$leng-3); //ID后三位之前的字符
            $rr =  $num . $paltfor.$men;
        }
        return $rr;

    }



    /*
     * 本周热门
     */
    public function weekhot(){
        $time = date("Y-m-d H:i:s",time());
      //  echo $time;
       // 1、获取一周前的日期
        $week=date("Y-m-d H:i:s",mktime(0,0,0,date("m"),date("d")-7,date("Y")));
  //  echo "select `ID`,`post_title` from tb_posts where post_modified  between '".$week."'  and '".$time."' and post_status ='publish' and comment_status='open' and ping_status ='open' and post_type='post'  order by comment_count desc limit 5";
        $weeklist = DB::connection('mysql_center')->select("select `ID`,`post_title` from tb_posts where post_modified  between '".$week."'  and '".$time."' and post_status ='publish' and comment_status='open' and ping_status ='open' and post_type='post'  order by comment_count desc limit 5");
        //echo $week;
        return $weeklist;

    }

    /*
     * 本月热门
     */
    public function monthhot(){
        $time = date("Y-m-d H:i:s",time());
        //2、获取一个月前的日期
        $month=date("Y-m-d H:i:s",mktime(0,0,0,date("m")-1,date("d"),date("Y")));
        $monthlist = DB::connection('mysql_center')->select("select `ID`,`post_title` from tb_posts where post_date  between '".$month."'  and '".$time."' and post_status ='publish' and comment_status='open' and ping_status ='open' and post_type='post'  order by comment_count desc limit 5");
        return $monthlist;
    }


    /*
     * 获取文章缩略图
     */
     public function getarticle_thumb(){
         //        thumb搜略图
         $thumb = DB::connection('mysql_center')->select("SELECT p.ID,p.guid,p.post_parent FROM tb_posts as p LEFT JOIN tb_posts  on tb_posts.ID = p.post_parent  WHERE p.post_type ='attachment' and p.post_mime_type = 'image/jpeg' ORDER BY p.ID DESC");
         // var_dump($thumb);
         $arr = array();
         foreach ($thumb as $key => $value){
             if(isset($arr[$value->post_parent])){

             }else{
                 $arr[$value->post_parent] = array();
                 array_push($arr[$value->post_parent],$value->guid);
                 // var_dump($value);
             }
         }
         return $arr;
     }


    /*
     * 获取文章详情图片
     * 使用 $match[1] 获取第一张图片
     */
    function get_all_url($code){

        $pattern = "/<img class=.+?src=\"(.*?)\" alt/";
        preg_match($pattern,$code,$match);
        return $match;
     }


    /*
     * 文章列表分页方法
     * 传值 从第几条数据开始
     * 每次取 10 条数据
     * 链接格式 /app/get_page_list?limit=20
     */
    function get_page_list(){
        $thumb = $this->getarticle_thumb();
        $page  = 20;
        if(!isset($_GET['limit'])){
            $limit = 0;
        }else{
            $limit = (int)$_GET['limit'];
        }
        if(isset($_GET['term'])){
            $term = (int)$_GET['term'];
            if($term==0){
                $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' ORDER BY posts.ID DESC  limit ".$limit.",".$page. "");
                foreach ($results as $key =>$vaule){
                    $vaule->post_content = Common::removeHtml($vaule->post_content );
                    if(isset($thumb[$vaule->ID][0])){
                        $vaule->thumb = "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$vaule->ID][0]."&h=142&w=240&zc=1";
                    }
                        //   = if(isseet();
                }
             //   var_dump($results);

              //  return $results;
            }else{
                $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' AND term.term_id = ".$term ." ORDER BY posts.ID DESC  limit ".$limit.",".$page. "");
                foreach ($results as $key =>$vaule){
                    $vaule->post_content = Common::removeHtml($vaule->post_content );
                    if(isset($thumb[$vaule->ID][0])){
                        $vaule->thumb = "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$vaule->ID][0]."&h=142&w=240&zc=1";
                    }
                }
            }

            return $results;
        }
    }
    /*
     * 搜索功能
     * s搜索的内容 content
     * type 类型
     * limit 页数
     */
    public function searchArticle(){
        // var_dump($this->weekhot());
        $weekhot =  $this->weekhot(); //本周热门
        $month = $this->monthhot(); //本月热门
        $page  = 10;

        if(!isset($_GET['limit'])){
            $limit = 0;
        }else{
            $limit = (int)$_GET['limit'];
        }

        if(isset($_GET['keyword'])){
            //type : 1：资讯，2：主播
            $keyword = $_GET['keyword'];

                $count = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.post_content  LIKE '%".$keyword ."%' ORDER BY posts.ID DESC ");
                //http://localhost/app/serch_articl?content=%E4%B8%BB%E6%92%AD&type=1&submit=%E6%90%9C%E7%B4%A2
                $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author  where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.post_content  LIKE '%".$keyword ."%' ORDER BY posts.ID DESC  limit ".$limit.",".$page. "");

           //  echo "SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.post_content  LIKE '%".$keyword ."%' ORDER BY posts.ID DESC  limit ".$limit.",".$page. "";
           //   die;
                $thumb = $this->getarticle_thumb();
                //  var_dump($results);
                foreach ($results as $key =>$vaule){
                    $vaule->post_content = Common::removeHtml($vaule->post_content );
                }
                return view('toubupc.artsearch')->with('results',$results)->with('thumb',$thumb)->with('keyword',$keyword)->with('count',$count)->with('weekhot',$weekhot)->with('month',$month);
            }




    }


    /*
 * 搜索关键词分页
 * s搜索的内容 content
 * type 类型
 * limit 页数
 */
    public function searchArticles(){
        // var_dump($this->weekhot());
        $weekhot =  $this->weekhot(); //本周热门
        $month = $this->monthhot(); //本月热门
        $page  = 10;

        if(!isset($_GET['limit'])){
            $limit = 0;
        }else{
            $limit = (int)$_GET['limit'];
        }

        if(isset($_GET['keyword'])){
            //type : 1：资讯，2：主播
            $keyword = $_GET['keyword'];

            $count = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.post_content  LIKE '%".$keyword ."%' ORDER BY posts.ID DESC ");
            $results = DB::connection('mysql_center')->select("SELECT posts.ID,posts.post_content,posts.post_modified,posts.post_title,posts.guid,users.display_name,term.name FROM tb_posts AS posts  LEFT JOIN tb_users AS users ON users.ID = posts.post_author LEFT JOIN tb_term_relationships AS ships ON posts.ID = ships.object_id LEFT JOIN tb_term_taxonomy AS tax ON tax.term_taxonomy_id = ships.term_taxonomy_id LEFT JOIN tb_terms AS term ON term.term_id = tax.term_id where posts.post_status ='publish' and posts.comment_status='open' and posts.ping_status ='open' and posts.post_type='post' and posts.post_content  LIKE '%".$keyword ."%' ORDER BY posts.ID DESC  limit ".$limit.",".$page. "");
            $thumb = $this->getarticle_thumb();
            foreach ($results as $key =>$vaule){
                $vaule->post_content = Common::removeHtml($vaule->post_content );
                if(isset($thumb[$vaule->ID][0])){
                    $vaule->thumb = "http://www.itoubu.com/wp/wp-content/themes/ui-2/timthumb.php?src=".$thumb[$vaule->ID][0]."&h=142&w=240&zc=1";
                }
            }
            return $results;
        }




    }



    /*
     * 多级菜单
     */
    public function searchStar(){

        $error = "searchStar ; user-agent : " . $_SERVER['HTTP_USER_AGENT'] . " , ip : " . $_SERVER["HTTP_X_REAL_IP"] . " , url : " . 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];

        if(Common::inStr(strtolower($_SERVER['HTTP_USER_AGENT']),"bot")){
            $error = "searchStar : not allow for bots --- " . $error;
            error_log($error);
            die();
        }else{
            //error_log($error);
        }

        $platform = DB::select("select * from platform where status =1");
       $city     = DB::select("select * from city_mini where parent=0 and id>1");
        $plat ="";
        $orderby =1; //排序
      // $limit = $_GET['limit'];
    $args = array();
    
    if(isset($_GET["platform"]) != false && $_GET["platform"] !=''){
          $plat .= " and u.platform=".$_GET['platform'];
      $args["platform"] = $_GET['platform'];
        }else{
      $args["platform"] = "";
    }
  
    
    if(isset($_GET["gender"]) != false && $_GET["gender"] !=''){
          $plat .= " and u.gender=" . $_GET['gender'];
      $args["gender"] = $_GET['gender'];
        }else{
      $args["gender"] = "";
    }
    
    
    if(isset($_GET["city"]) != false && $_GET["city"] !=''){
          $plat .= " and u.city in (SELECT id FROM `city_mini` WHERE `parent` = ".$_GET['city']." or `id` =".$_GET['city'] .") ";                     //$_GET['city'];
      $args["city"] = $_GET['city'];
        }else{
      $args["city"] = "";
    }
    
    
    if(isset($_GET["follower"]) != false && $_GET["follower"] !='' && strpos($_GET["follower"],"-") > -1){
      
      $arr = explode("-",$_GET["follower"]);
      $plat .= " and u.follower between ".$arr[0]*10000 ." and " .$arr[1]*10000 ." ";
      
      $args["follower"] = $_GET['follower'];
        }else{
      $args["follower"] = "";
    }
  
  
    if(isset($_GET["income"]) != false && $_GET["income"] !='' && strpos($_GET["income"],"-") > -1){
      
      $arr = explode("-",$_GET["income"]);
      $plat .= " and u.rmb between ".$arr[0]*10000 ." and " .$arr[1]*10000 ." ";
      
      $args["income"] = $_GET['income'];
        }else{
      $args["income"] = "";
    }
    
    
    
    if(isset($_GET["keyword"]) != false && $_GET["keyword"] !=''){
      if(is_numeric($_GET["keyword"])){
        $plat .= " and u.`platformid` = ". $_GET["keyword"] ."";
      }else{
            $plat .= " and x.`nickname`  LIKE '". $_GET["keyword"] ."%'";
      }
      // $sql ="SELECT users.`nickname`,users.platform,users.`follower`,users.`cityname`  FROM `users` LEFT JOIN `platform` on users.`platform` = `platform`.id LEFT JOIN `city_mini` on users.`city` =`city_mini` .id   WHERE users.`nickname`  LIKE '%".$content ."%'  ORDER BY users.rmb desc limit 300; ";
      $args["keyword"] = $_GET['keyword'];
        }else{
      $args["keyword"] = "";
    }
    
    
    if(isset($_GET["orderby"]) != false && $_GET["orderby"] !=''){
          $plat .=" order by u.".$_GET["orderby"]." desc";
      $args["orderby"] = $_GET['orderby'];
        }else{
      $plat .=" order by u.indexnum desc";
      $args["orderby"] = "indexnum"; 
    }

        if(isset($_GET["limit"]) != false && $_GET["limit"] !=''){
            $sql = "select u.*,'' as name from users as u inner join users x on u.platformid=x.platformid and u.platform=x.platform where 1" . $plat . " limit ".$_GET["limit"]." ,100";
            $search_results = DB::select($sql);
            return $search_results;
        }
        $sql = "select u.*,'' as name from users as u inner join users x on u.platformid=x.platformid and u.platform=x.platform where 1" . $plat . " limit 100";

        $search_results = DB::select($sql);

        return view('toubupc.zbsearch')->with('platform',$platform)->with('city',$city)->with('search_results',$search_results)->with('args',$args);

    }


   
    /*
     * Index Banner图
     */
    public function getBanner(){
        $results = DB::connection('mysql_center')->select("SELECT option_name,option_value FROM tb_options where option_name ='banner-1' or option_name ='banner-2' or option_name ='banner-3' or option_name ='banner-4' or option_name ='banner-5' or option_name ='burl-1' or option_name ='burl-2' or option_name ='burl-3' or option_name ='burl-4' or option_name ='burl-5'");
        //   var_dump($results);
        foreach ($results as $key =>$value ){
            if($value->option_name =='banner-1'){
                $arr[0]['img'] = $value->option_value;
            }
            if($value->option_name =='banner-2'){
                $arr[1]['img'] =$value->option_value;
            }
            if($value->option_name =='banner-3'){
                $arr[2]['img'] =$value->option_value;
            }
            if($value->option_name =='banner-4'){
                $arr[3]['img'] =$value->option_value;
            }
            if($value->option_name =='banner-5'){
                $arr[4]['img'] =$value->option_value;
            }
            if($value->option_name =='burl-1'){
                // $arr[0]['url'] =$value->option_value;
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[0]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else{
                    $arr[0]['url'] =$value->option_value;
                }
            }
            if($value->option_name =='burl-2'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[1]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[1]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='burl-3'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[2]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[2]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='burl-4'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[3]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[3]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='burl-5'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[4]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[4]['url'] = $value->option_value;
                }
            }
        }

        $arrTemp = $arr;
        for($i=0;$i<count($arrTemp);$i++){
            if($arr[$i]["img"] == "" && $arr[$i]["url"] == ""){
                unset($arr[$i]);
            }

        }
        return $arr;

    }
    /*
     * 观察 banner图
     */
    public function viewbanner(){
        $results = DB::connection('mysql_center')->select("SELECT option_name,option_value FROM tb_options where option_name ='url-1' or option_name ='url-2' or option_name ='url-3' or option_name ='url-4' or option_name ='url-5' or option_name ='flash-1' or option_name ='flash-2' or option_name ='flash-3' or option_name ='flash-4' or option_name ='flash-5' or option_name ='title-1' or option_name ='title-2' or option_name ='title-3' or option_name ='title-4' or option_name ='title-5'   ");

        //  var_dump($results);
        foreach ($results as $key =>$value ){
            if($value->option_name =='flash-1'){
                $arr[0]['img'] = $value->option_value;
            }
            if($value->option_name =='flash-2'){
                $arr[1]['img'] =$value->option_value;
            }
            if($value->option_name =='flash-3'){
                $arr[2]['img'] =$value->option_value;
            }
            if($value->option_name =='flash-4'){
                $arr[3]['img'] =$value->option_value;
            }
            if($value->option_name =='flash-5'){
                $arr[4]['img'] =$value->option_value;
            }
            if($value->option_name =='url-1'){
                // $arr[0]['url'] =$value->option_value;
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[0]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else{
                    $arr[0]['url'] =$value->option_value;
                }
            }
            if($value->option_name =='url-2'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[1]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[1]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='url-3'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[2]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[2]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='url-4'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[3]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[3]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='url-5'){
                $var=explode("/",$value->option_value);
                $leng= count($var);
                if(is_numeric($var[$leng-1]) && strpos($var[$leng-2],'detail')!==false){
                    $arr[4]['url'] = '/articl_detail?id='.$var[$leng-1];
                }else {
                    $arr[4]['url'] = $value->option_value;
                }
            }
            if($value->option_name =='title-1'){
                $arr[0]['title'] = $value->option_value;
            }
            if($value->option_name =='title-2'){
                $arr[1]['title'] = $value->option_value;
            }
            if($value->option_name =='title-3'){
                $arr[2]['title'] = $value->option_value;
            }
            if($value->option_name =='title-4'){
                $arr[3]['title'] = $value->option_value;
            }
            if($value->option_name =='title-5'){
                $arr[4]['title'] = $value->option_value;
            }
        }
        $arrTemp = $arr;
        for($i=0;$i<count($arrTemp);$i++){
            if($arr[$i]["img"] == "" && $arr[$i]["url"] == ""){
                unset($arr[$i]);
            }

        }

        return $arr;
    }


    /*
     * 单日主播收入榜
     */
    public function allincome()
    {

        $plat = DB::select("select * from platform where status =1");


        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }else{
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        if (isset($_GET['plat'])) {
            $platform = (int)$_GET['plat'];

            $result = DB::select("SELECT * FROM `singleincome` where `idate`= '" . $endtime . "' and groups=".$platform." ");

        } else {
            $result = DB::select("SELECT * FROM `singleincome` where `idate`= '" . $endtime . "' and groups= 0 ");

        }

        return view('toubupc.dayincome')->with('result',$result)->with('plat',$plat);
    }

    /*
    *    娱乐主播活跃指数
    */
    public function dayhot()
    {

        $platform = DB::select("select * from platform where status =1");
        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }else{
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        if(isset($_GET['plat'])){
            $palt = (int)$_GET['plat'];
            $platsql =  "SELECT * FROM `activeindex` where `idate`= '" . $endtime . "' and groups=".$palt." ";
        }else{
            $platsql =   "SELECT * FROM `activeindex` where `idate`= '" . $endtime . "' and groups=0 ";

        }
        $platmba = DB::select($platsql);
        return view('toubupc.dayhot')->with('result',$platmba)->with('platform',$platform);
    }





    /*
     * 单日主播粉丝排行
     */
    public function dayfans(){
        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime      =  date("Y-m-d",strtotime("-1 day"));
        }else{
            $endtime      =  date("Y-m-d",strtotime("-2 day"));
        }
        $plat = DB::select("select * from platform where status =1");
        if (isset($_GET['plat'])) {

            $platform = (int)$_GET['plat'];
                $result = DB::select("SELECT * FROM `singlefans` where `idate`= '" . $endtime . "' and groups=".$platform." ");


        }else{
            $result = DB::select("SELECT * FROM `singlefans` where `idate`= '" . $endtime . "' and groups= 0 ");

        }
        return view('toubupc.dayfans')->with('result',$result)->with('plat',$plat);
    }


     /*
      * 行业指数
      */
    public function hymba(){
        if(isset($_GET['starttime'])&&isset($_GET['endtime'])){
            $starttime = $_GET['starttime'];
            $endtime   = $_GET['endtime'];
        }else{
        $starttime = date("Y-m-d",mktime(0,0,0,date("m"),date("d")-14,date("Y")));
        $endtime      =  date("Y-m-d",strtotime("-1 day"));

        }
        $sql ="SELECT `index`,`idate` FROM `rank_log` WHERE `platform` =0 AND idate BETWEEN '".$starttime ."' and '".$endtime."'";
        $hymba  = DB::select($sql);  //行业指数
        return $hymba;
    }




    /*
     * 主播热度榜
     */
     public function yesterdayhotlist(){
         $hourse = date("H", time());
         if($hourse>=9) {
             $endtime      =  date("Y-m-d",strtotime("-1 day"));
         }else{
             $endtime      =  date("Y-m-d",strtotime("-2 day"));
         }
         $platsql = "SELECT * FROM `activeindex` where `idate`= '" . $endtime . "' and groups=0 limit 0,5 ";
     //  echo $platsql; die;
       //  $platsql = "SELECT u.`platform`,   u.`platformid`,  u.`nickname`, u.`avatar`,   log.`indexnum`,  plat.`name` FROM `income_log` as log  LEFT JOIN `platform` as plat on plat.`id`= log.`platform` LEFT JOIN `users` as u on u.`platform`= log .platform   and u.`platformid`= log .platformid WHERE log.idate=  '" . $endtime . "' ORDER BY log .indexnum desc limit 0, 5";

         $platmba = DB::select($platsql);
         return $platmba;
     }


     /*
     * 昨日平台指数
     */
    public function yesterdayplatmba(){
        $hourse = date("H", time());
        if($hourse>=9) {
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }else{
            $endtime = date("Y-m-d", strtotime("-2 day"));
        }
        $platsql = "SELECT `rank_log` .index,`platform` .name,`platform`.id FROM `rank_log` LEFT JOIN `platform`  on `rank_log` .`platform` =`platform` .id   WHERE `rank_log` .`idate` ='" . $endtime . "' and `platform`.`status`=1 order by `rank_log` .index desc limit 0,5";



        $platmba = DB::select($platsql);

        return $platmba;
    }



    /*
     * 平台指数
     */
    public function platmba(){
        if(isset($_GET['starttime'])&&isset($_GET['endtime'])){
               $starttime = $_GET['starttime'];
               $endtime   = $_GET['endtime'];
        }else {
            $starttime = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 14, date("Y")));
            $endtime = date("Y-m-d", strtotime("-1 day"));
        }
        $platsql = "SELECT `index`,`platform`,`idate` FROM `rank_log` WHERE `platform` =0 AND idate BETWEEN '" . $starttime . "' and '" . $endtime . "'";

        $platmba = DB::select($platsql);
        return $platmba;

    }

    /*
 * 平台活跃指数
 */
    public function plathymba(){
        if(isset($_GET['starttime'])&&isset($_GET['endtime'])){
            $starttime = $_GET['starttime'];
            $endtime   = $_GET['endtime'];

        }else {
            $starttime = date("Y-m-d", mktime(0, 0, 0, date("m"), date("d") - 14, date("Y")));
            $endtime = date("Y-m-d", strtotime("-1 day"));

        }

        $platsql = "SELECT log.`index`,log.`idate`,plat.`name`,plat.`color`  FROM `rank_log` as log LEFT JOIN `platform` as plat on plat.`id` =log.`platform`   WHERE plat.status=1 AND log.idate BETWEEN '" . $starttime . "' and '" . $endtime . "'";


        $platmba = DB::select($platsql);

        $plat = DB::select("select `name`,`color` from platform where status =1");



        $_time = range(strtotime($starttime), strtotime($endtime), 24*60*60);

        $_time = array_map(create_function('$v', 'return date("Y-m-d", $v);'), $_time);

        $n=0;
        for ($j=0; $j<count($plat);$j++) {
            for ($i=0; $i<count($_time);$i++) {
                $datearr[$n]['idate'] =$_time[$i];
                $datearr[$n]['name']  =$plat[$j]->name;
                $datearr[$n]['color'] = $plat[$j]->color;
                $datearr[$n]['index']  =null;
                $n++;
            }

        }


        for ($j=0; $j<count($datearr);$j++) {
            for ($i = 0; $i < count($platmba); $i++) {
                if ($datearr[$j]['idate'] == $platmba[$i]->idate) {

                    if ($datearr[$j]['name'] == $platmba[$i]->name) {
                       // $datearr[$j]['color'] = $platmba[$i]->color;
                        $datearr[$j]['index'] = $platmba[$i]->index;
                    }
                }

            }
        }



        return $datearr;

    }





    /*
     * 是否在直播
     */
  public function check_lives($platform,$userid)
//        public function check_lives()
//
        {
//      $platform =2;
//      $userid   = 18813158;
      $arr = array();

      if ($platform == 1) {    //映客
          $url = "http://service.inke.com/api/live/now_publish?imsi=&uid=&proto=5&idfa=CC528020-8D86-4291-927E-FA712C636768&lc=0000000000000026&cc=TG0001&imei=&sid=20G45xJ7rO0qv38i1si1mxjsrj7svmbvypG23QXrfOEYLvGnmi0Mi3&cv=IK3.1.00_Iphone&devi=8c7b856e2895f4548c3c4083a3c6e1093e19109d&conn=Wifi&ua=iPhone&idfv=E2367328-B69B-4C6D-B12B-9CF7B49207E5&osversion=ios_9.300000&id=" . $userid . "&multiaddr=1";
          $re = Common::http_get($url);
          $liveinfo = json_decode($re);
          if (isset($liveinfo->live)) {
              $arr['title'] = $liveinfo->live->name;
              $arr['cover'] = $liveinfo->live->image;
              $arr['url'] = $liveinfo->live->share_addr;
              return $arr;
          }
      } else if ($platform == 7) {      //一直播
          //http://www.yizhibo.com/l/ FAp1lDeZaCpZDnp9 .html
          $liveinfo = Xxtea::getLiveInfo($userid);     //直播间名字，图片，直播地址，
          if ($liveinfo != "") {
              $arr['title'] = $liveinfo->title;
              $arr['cover'] = $liveinfo->avatar;
              $arr['url'] = "http://www.yizhibo.com/l/" . $liveinfo->scid . ".html";
              return $arr;
          }
      } else if ($platform == 3) {//花椒  /
          $rand = rand(100000000, 9999999999);
          $time = time();
          $line = "deviceid=3ccc323a0a7828d54b54af7d7d4a8475netspeed=0network=Wi-Fiplatform=iosrand=" . $rand . "time=" . $time . "userid=52611531version=3.8.0eac63e66d8c4a6f0303f00bc76d0217c";
          $guid = MD5($line);
          $url = "http://live.huajiao.com/feed/getUserFeeds?deviceid=3ccc323a0a7828d54b54af7d7d4a8475&netspeed=0&network=Wi-Fi&platform=ios&rand=" . $rand . "&time=" . $time . "&userid=52611531&version=3.8.0&guid=" . $guid . "&model=iPhone6,1&channel=Apple&clientip=&dui=3ccc323a0a7828d54b54af7d7d4a8475&num=40&privacy=Y&uid=" . $userid;
          $gxs = Common::http_get($url);

          $info = json_decode($gxs);
          if ($info->data->feeds) {
              if ($info->data->feeds[0]->type == '1') {
                  //http://www.huajiao.com/l/46126350
                  $arr['title'] = $info->data->feeds[0]->feed->title;
                  $arr['cover'] = $info->data->feeds[0]->feed->image;
                  $arr['url'] = "http://www.huajiao.com/l/" . $info->data->feeds[0]->feed->relateid;
                  return $arr;
              }
          }

      } else if ($platform == 5) {    //全民
          $endtime = date("YmdHis", time());
          $url = "http://www.quanmin.tv/json/rooms/" . $userid . "/info4.json?_t=" . $endtime;
          $gxs = Common::http_get($url);
          $info = json_decode($gxs);
          if ($info->play_status) {
              $arr['title'] = $info->title;
              $arr['cover'] = $info->avatar;
              $arr['url'] = "http://www.quanmin.tv/v/" . $info->uid;
              return $arr;
          }
      } else if($platform == 9) {   //来疯
          //获取主播详细信息
          $time = number_format(microtime(true), 3, '', '');
          $url = "http://v.laifeng.com/card?userId=" . $userid . "&_=" . $time;
          $gxs = Common::http_get($url);
          $info = json_decode($gxs);
          $roomId = $info->response->data->roomId;
          $live = "http://v.laifeng.com/" . $roomId;
          $liveinfo = Common::http_get($live);
          $isShowing = common::getStr($liveinfo, "isShowing:", ",");
          if ($isShowing != 'false') {
              //   echo 111;
              $roomId = $info->response->data->roomId;
              $arr['title'] = $info->response->data->nickName;
              $arr['cover'] = $info->response->data->faceUrl;
              $arr['url'] = "http://v.laifeng.com/" . $roomId;
              return $arr;
          }

      }else if($platform == 4){ //熊猫直播
          $time = number_format(microtime(true), 3, '', '');
         $liveid =DB::select("SELECT `lastliveid` FROM `users` WHERE `platform` =4 AND  `platformid` =".$userid." ");
          //http://www.panda.tv/api_room_v2?roomid=10007&pub_key=&__plat=pc_web&_=1478850784540
          $url ='http://www.panda.tv/api_room_v2?roomid='.$liveid[0]->lastliveid.'&pub_key=&__plat=pc_web&_='.$time;
          $gxs = Common::http_get($url);
          $info = json_decode($gxs);
          if($info->data->roominfo->status==2){
              $roomId = $liveid[0]->lastliveid;
              $arr['title'] = $info->data->roominfo->name;
              $arr['cover'] = $info->data->roominfo->pictures->img;
              $arr['url'] = "http://www.panda.tv/" . $roomId;
              return $arr;
          }

      }else if($platform == 6){ //哈尼直播
        $url ='https://web.immomo.com/webmomo/api/scene/profile/infosv2';
          $stid = "stid=".$userid;
          $cookie ='MMID=9c10215538d589409240a33f965f07f0; MMSSID=3496f70e63e6344d20598150ba1054eb; Hm_lvt_96a25bfd79bc4377847ba1e9d5dfbe8a=1478849182; Hm_lpvt_96a25bfd79bc4377847ba1e9d5dfbe8a=1478849182; __v3_c_sesslist_10052=ek7hxnsmkb_d7g; __v3_c_pv_10052=1; __v3_c_session_10052=1478849181305915; __v3_c_today_10052=1; __v3_c_review_10052=0; __v3_c_last_10052=1478849181305; __v3_c_visitor=1478162299762468; __v3_c_session_at_10052=1478849181901; s_id=040b95821bdf6d22fc0c4bc71afa2b53; cId=84918400873391; Hm_lvt_c391e69b0f7798b6e990aecbd611a3d4=1478849184; Hm_lpvt_c391e69b0f7798b6e990aecbd611a3d4=1478849184';
          $gxs = Common::_http_post($url,$stid,$cookie);
          $info = json_decode($gxs);

          if(isset($info->data->live) && $info->data->live){

              $arr['title'] = $info->data->title;
              $arr['cover'] = "";
              $arr['url'] = "https://web.immomo.com/live/" . $userid;
              return $arr;
          }
      }else if($platform ==10){
          $liveid =DB::select("SELECT `lastliveid` FROM `users` WHERE `platform` =10 AND  `platformid` =".$userid." ");
          $url    = "http://open.douyucdn.cn/api/RoomApi/room/".$liveid[0]->lastliveid;
          $gxs = Common::http_get($url);
          $info = json_decode($gxs);
          if($info->data->room_status=='1'){
              $roomId = $liveid[0]->lastliveid;
              $arr['title'] = $info->data->room_name;
              $arr['cover'] = $info->data->room_thumb;
              $arr['url'] = "https://www.douyu.com/" . $roomId;
              return $arr;
          }

       //   var_dump($info);
      }else if($platform == 2){

          $liveid =DB::select("SELECT `lastliveid` FROM `users` WHERE `platform` =2 AND  `platformid` =".$userid." ");

          if($liveid[0]->lastliveid) {
              $url = "http://www.myhug.cn/u/profile?yUId=".$liveid[0]->lastliveid."&subUrlType=hls&apiVersion=4.0.7&appVersion=4.0.7&app=wx_baobao&appName=wap_wx&sig=2b06c09ad1adc190f66c2f2e9dd9048d1";
              $gxs = Common::http_get($url);
              $info = json_decode($gxs);
              if($info->user->userZhibo->zId){
                  $roomId = $liveid[0]->lastliveid;
                  $arr['title'] = "";
                  $arr['cover'] = "";
                  $arr['url'] = "http://www.myhug.cn/wap/z/entry.html?yUId=".$roomId."&from=singlemessage&isappinstalled=1";
                  return $arr;
              }
          }
      }else if($platform==8){
          $liveid =DB::select("SELECT `lastliveid` FROM `users` WHERE `platform` =8 AND  `platformid` =".$userid." ");
          $url    = "http://www.meipai.com/live/".$liveid[0]->lastliveid;
          $gxs = Common::http_get($url);
          $rule = '/\isStop:.*/';  ;//正则表达式
          preg_match($rule,$gxs,$result);
         $arre = substr($result[0], 0, -1);
         $var=explode(":",$arre);
          $var[1] = trim($var[1]);
          if($var[1] =='false'){
              $roomId = $liveid[0]->lastliveid;
              $arr['title'] = "";
              $arr['cover'] = "";
              $arr['url'] = "http://www.meipai.com/live/".$roomId;
              return $arr;
          }
      }
      return null;
  }


  public function everyplat(){

      if(!isset($_GET['plat'])){
          $plat =1;
      }else{
          $plat = $_GET['plat'];
      }

     $inke = DB::select("select * from users as u LEFT JOIN platform as plat on plat.id = u.platform where plat.id=".$plat." and plat.status=1  ORDER by u.rmb desc limit 10");

      return view('toubu')->with('result',$inke);
  }





    /*
     *主播收入统计
     */
    public function zbincome()
    {

        //正常状态
        $userid = $_GET['platformid'];
        $plat   = $_GET['platform'];
        $hourse = date("H", time());
        if($hourse>=9) {
            $startime = strtotime("-14 day");
            $endtimes = strtotime("-1 day");
            $start      =  date("Y-m-d",strtotime("-14 day"));
            $endtime      =  date("Y-m-d",strtotime("-1 day"));
        }else{
            $startime = strtotime("-15 day");
            $endtimes = strtotime("-2 day");
            $start      =  date("Y-m-d",strtotime("-15 day"));
            $endtime      =  date("Y-m-d",strtotime("-2 day"));
        }
        $i=0;
        while($startime <= $endtimes){
            $datearr[$i]['idate'] = date('Y-m-d',$startime);//得到dataarr的日期数组。
            $datearr[$i]['increase_rmb'] = 0;
            $datearr[$i]['increase'] = 0;
            $datearr[$i]['income'] = 0;
            $startime=$startime + 3600*24;
            $i++;
        }
        // var_dump($datearr);

        if($hourse>=9) {
            $result = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = '" . $plat . "' and `platformid` = " . $userid . " and idate BETWEEN   '". $start."' and '".$endtime."'  order by idate asc  ");
        }else{
            $result = DB::select("SELECT `increase` ,`income`,`increase_rmb`,`idate`  FROM income_log where `platform` = '" . $plat . "' and `platformid` = " . $userid . " and idate BETWEEN   '". $start."' and '".$endtime."'  order by idate asc  ");
        }
        for($i=0; $i<count($result); $i++){
            for($j=0; $j<count($datearr);$j++){
                if($result[$i]->idate ==$datearr[$j]['idate']){
                    $datearr[$j]['increase_rmb'] = $result[$i]->increase_rmb;
                    $datearr[$j]['increase'] = $result[$i]->increase;
                    $datearr[$j]['income'] = $result[$i]->income;
                }
            }
        }

        return $datearr;

    }
    /*
    * 主播粉丝统计
    */

    public function zbfan(){

            //正常状态
            $userid = $_GET['platformid'];
            $plat   = $_GET['platform'];
        $hourse = date("H", time());
        if($hourse>=9) {
            $start      =  date("Y-m-d",strtotime("-14 day"));
            $endtime      =  date("Y-m-d",strtotime("-1 day"));
            $startime = strtotime("-14 day");
            $endtimes = strtotime("-1 day");
        }else{
            $start      =  date("Y-m-d",strtotime("-15 day"));
            $endtime      =  date("Y-m-d",strtotime("-2 day"));
            $startime = strtotime("-15 day");
            $endtimes = strtotime("-2 day");
        }
        $i=0;
        while($startime <= $endtimes){
            $datearr[$i]['idate'] = date('Y-m-d',$startime);//得到dataarr的日期数组。
            $datearr[$i]['increase_follower'] = 0;
            $datearr[$i]['follower'] = 0;
            $startime=$startime + 3600*24;
            $i++;
        }
        if($hourse>=9) {
            $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = '" . $plat . "' and `platformid` = " . $userid . " and idate BETWEEN '". $start."' and '".$endtime."' order by idate asc");
        }else{
            $result = DB::select("SELECT `increase_follower` ,`follower`,`idate`  FROM income_log where `platform` = '" . $plat . "' and `platformid` = " . $userid . " and idate BETWEEN   '". $start."' and '".$endtime."' order by idate asc");
        }

        for($i=0; $i<count($result); $i++){
            for($j=0; $j<count($datearr);$j++){
                if($result[$i]->idate ==$datearr[$j]['idate']){
                    $datearr[$j]['increase_follower'] = $result[$i]->increase_follower;
                    $datearr[$j]['follower'] = $result[$i]->follower;
                }
            }
        }






        return $datearr;
        }



}