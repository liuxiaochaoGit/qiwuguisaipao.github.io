<?php

	// php 两种请求方式：1.curl（client url）2.socket

	/*
		1.初始化一个curl
		2.对curl 进行配置
		3.执行curl
		4.关闭curl
	*/
	// get 请求
	function httpGet($url){
		// 1.初始化
		$curl = curl_init();

		// 2.配置curl
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// 3.执行curl
		$res = curl_exec($curl);

		// 4.关闭curl
		curl_close($curl);

		return $res;
	}

	$url = " https://api.weixin.qq.com/cgi-bin/user/info?access_token=NrW2uL70YGtrSPiW0YTaGYBBv9kJfhFGhbvQvRydDrGVZng_qyXJ7vwv4JbgJlyZW0GD0JGNruPCHvOuEPgU1rH90TiqHR14POSlf866T8xllfdo8BtUuaNQJ84L8SbqRZJdAIAEMW&openid=ohsFzwdgNqp11756V6K2UzfGguVo&lang=zh_CN ";

	$response = httpGet($url);

	// 获取 access_token
	echo $response;


	// post 请求
	function httpPost($url,$data){
		// 1.初始化
		$curl = curl_init();

		// 2.配置
		curl_setopt($curl, CURLOPT_POST, true);  //设置为 post 请求
		curl_setopt($curl, CURLOPT_URL, $url);		//设置请求url
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);  //设置请求的参数
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		// 3.执行
		$res = curl_exec($curl);

		// 4.释放
		curl_close($curl);

		return $res;
	}

	// $url = "https://api.weixin.qq.com/cgi-bin/user/info/updateremark?access_token=NrW2uL70YGtrSPiW0YTaGYBBv9kJfhFGhbvQvRydDrGVZng_qyXJ7vwv4JbgJlyZW0GD0JGNruPCHvOuEPgU1rH90TiqHR14POSlf866T8xllfdo8BtUuaNQJ84L8SbqRZJdAIAEMW";
	// $data = '{
	// 		"openid":"ohsFzwdgNqp11756V6K2UzfGguVo",
	// 		"remark":"刘振超"
	// 	}';
	// echo httpPost($url,$data);
 ?>

<!-- NrW2uL70YGtrSPiW0YTaGYBBv9kJfhFGhbvQvRydDrGVZng_qyXJ7vwv4JbgJlyZW0GD0JGNruPCHvOuEPgU1rH90TiqHR14POSlf866T8xllfdo8BtUuaNQJ84L8SbqRZJdAIAEMW -->


















