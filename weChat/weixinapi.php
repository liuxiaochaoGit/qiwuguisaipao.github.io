<?php

	class Weixin{
		private $appID = "wx5553bc266ac17bfd";
		private $appsecret = "282218163e3213d1ea1e83fae4bd282c";


		function getAccessToken(){

			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$this->appID}&secret={$this->appsecret}";
			// json  字符串
			$json = $this->httpGet($url);
			$obj = json_decode($json);
			return $obj->access_token;
		}
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

		function createMenu(){
			$access_token = $this->getAccessToken();
			$url = " https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
			$postBody = '{
			     "button":[
			      {
			           "name":"点击事件",
			           "sub_button":[
			           {
			               "type":"click",
			               "name":"发送文字",
			               "key":"sendText",
			               "sub_button":[]
			            },
			            {
			               "type":"click",
			               "name":"发送图片",
			               "key":"sendImage",
			               "sub_button":[]
			            },
			            {
			               "type":"click",
			               "name":"发送语音",
			               "key":"sendVoice",
			               "sub_button":[]
			            },
			            {
			               "type":"click",
			               "name":"发送视频",
			               "key":"sendVideo",
			               "sub_button":[]
			            }]
			       },{
						"name":"扫码相册",
						"sub_button":[{
							"type":"pic_sysphoto",
							"name":"相机",
							"key":"camera",
							"sub_button":[]
						},
						{
							"type":"scancode_push",
							"name":"扫码",
							"key":"scancode",
							"sub_button":[]
						},
						{
							"type":"location_select",
							"name":"定位",
							"key":"location",
							"sub_button":[]
						}]
			       }]
			 }';

			return $this->httpPost($url,$postBody);
		}

		function deleteMenu(){
			$access_token = $this->getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token={$access_token}";
			return $this->httpGet($url);
		}
		function uploadMedia($type,$filename){
			$access_token = $this->getAccessToken();
			$url = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token={$access_token}&type={$type}";
			$postBody = array("media"=>"@".realpath($filename));
			return $this->httpPost($url,$postBody);

		}
	}
	$wx = new Weixin();
	// echo $wx->getAccessToken();

	// echo $wx->createMenu();

	// echo $wx->deleteMenu();

	echo $wx->uploadMedia("image","1.jpg");

 ?>