<?php

	error_reporting(E_ALL);
	ini_set('display_errors', '1'); 

	function testMem(){
		
		$stime=microtime(true); 
		
		$memcache = new Memcache();
		$memcache->addServer('a9e62c6b48004d35.m.cnbjalinu17pub001.ocs.aliyuncs.com:11211');
		
		$rand = rand();
		
		for($i=0;$i<20000;$i++){
			
			$memcache->set($rand.$i,'1234567890');
			$memcache->get($rand.$i);
			
		}
		
		echo $memcache->get($rand.$i);
		
		$memcache->close();
		
		
		echo "<br />";
		$etime=microtime(true);//获取程序执行结束的时间
		$total=$etime-$stime;   //计算差值
		
		echo $total;
			
	}
	
	
	
	
	function testRedis(){
		
		$stime=microtime(true); 
		
		$redis = new Redis();
		$redis->connect('r-2ze66e34895051e4.redis.rds.aliyuncs.com',6379);
		$redis->auth('Toubu123');
		
		for($i=0;$i<5000;$i++){
			
			$redis->set('myname','1234567890');
			$redis->get('myname');
			
		}
		
		echo $redis->get('myname');
		
		$redis->close();
		
		
		echo "<br />";
		$etime=microtime(true);//获取程序执行结束的时间
		$total=$etime-$stime;   //计算差值
		
		echo $total;
			
	}
	
	
	testRedis();

?>