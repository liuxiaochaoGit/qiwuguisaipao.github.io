<?php

	// 最简单的验证方式
	// echo $_GET["echostr"];

	// 验证是否是来自于微信
	function checkWeixin(){
		// 微信会发送四个参数到我们的服务器后台  签名 时间戳   随机字符串  随机数

		$signature = $_GET["signature"];
		$timestamp = $_GET["timestamp"];
		$nonce = $_GET["nonce"];
		$echostr = $_GET["echostr"];
		$token = "liuzhenchao";

		// 1）将token、timestamp、nonce三个参数进行字典序排序
		$tmpArr = array($nonce,$timestamp,$signature);
		sort($tmpArr,SORT_STRING);

		// 2）将三个参数字符串拼接成一个字符串进行sha1加密
		$str = implode($tmpArr);
		$sign = sha1($str);

		// 3）开发者获得加密后的字符串可与signature对比，标识该请求来源于微信
		if($sign == $signature){
			echo $echostr;
		}
	}
	// checkWeixin();



	// 服务器处理微信转发过来的数据

	// 1.获取xml数据  微信用户发过来的消息或者事件
	$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

	// 判断 postStr 是否为空
	if(!empty($postStr)){
		// 如果不为空，引入xml 解析库
		libxml_disable_entity_loader(true);
		// 将 $postStr 进行解析
      	$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);

      	// 获取消息的类型
      	$MsgType = $postObj->MsgType;
      	switch ($MsgType) {
      		case 'text':
      			echo handleText($postObj);
      			break;
      		case 'image':
      			echo handleImage($postObj);
      			break;
      		case 'voice':
      			echo handleVoice($postObj);
      			break;
      		case 'video':
	      		echo handleVideo($postObj);
	      		break;
	      	case 'event':
	      		echo handleEvent($postObj);
	      		break;
      		default:
      			echo "";
      			break;
      	}
	}
	// 文本
	function handleText($postObj){
		// 获取公众号的id
		$ToUserName = $postObj->ToUserName;
		// 粉丝的id
		$FromUserName = $postObj->FromUserName;
		// 拿到用户发的信息
		$Content = $postObj->Content;

		$sendText = "收到" . $Content;

		$time = time();  //获取当前的时间

		$echostr = <<<TTT
			<xml>
			<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
			<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
			<CreateTime>{$time}</CreateTime>
			<MsgType><![CDATA[text]]></MsgType>
			<Content><![CDATA[{$sendText}]]></Content>
			</xml>
TTT;
		return $echostr;
	}
	// 图片
	function handleImage($postObj){
		// 获取公众号的id
		$ToUserName = $postObj->ToUserName;
		// 粉丝的id
		$FromUserName = $postObj->FromUserName;
		// 拿到用户发的图片的媒体id
		$MediaId = $postObj->MediaId;

		$time = time();

		$echostr = <<<III
			<xml>
			<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
			<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
			<CreateTime>{$time}</CreateTime>
			<MsgType><![CDATA[image]]></MsgType>
			<Image>
			<MediaId><![CDATA[{$MediaId}]]></MediaId>
			</Image>
			</xml>
III;
		return $echostr;


	}
	// 语音
	function handleVoice($postObj){
		// 获取公众号的id
		$ToUserName = $postObj->ToUserName;
		// 粉丝的id
		$FromUserName = $postObj->FromUserName;
		// 拿到用户发的音频的媒体id
		$MediaId = $postObj->MediaId;

		$time = time();
		$echostr = <<<VVV
			<xml>
			<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
			<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
			<CreateTime>{$time}</CreateTime>
			<MsgType><![CDATA[voice]]></MsgType>
			<Voice>
			<MediaId><![CDATA[{$MediaId}]]></MediaId>
			</Voice>
			</xml>
VVV;
		return $echostr;
	}
	// 视频
	function handleVideo($postObj){
		// 获取公众号的id
		$ToUserName = $postObj->ToUserName;
		// 粉丝的id
		$FromUserName = $postObj->FromUserName;
		// 拿到用户发的视频的媒体id
		$MediaId = $postObj->MediaId;

		$time = time();
		$echostr = <<<VVV
			<xml>
			<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
			<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
			<CreateTime>{$time}</CreateTime>
			<MsgType><![CDATA[video]]></MsgType>
			<Video>
			<MediaId><![CDATA[{$MediaId}]]></MediaId>
			<Title><![CDATA[title]]></Title>
			<Description><![CDATA[description]]></Description>
			</Video>
			</xml>
VVV;
		return $echostr;
	}

	// 事件
	function handleEvent($postObj){
		// 获取公众号的id
		$ToUserName = $postObj->ToUserName;
		// 粉丝的id
		$FromUserName = $postObj->FromUserName;
		$Event = $postObj->Event;

		switch ($Event) {
			case 'CLICK':
				// 获取二级菜单中的CLICKKEY
				$EventKey = $postObj->EventKey;
				if($EventKey == "sendText"){
					$sendText = "发送文字测试";
					$time = time();
					$echostr = <<<TTTTT
						<xml>
						<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
						<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
						<CreateTime>{$time}</CreateTime>
						<MsgType><![CDATA[text]]></MsgType>
						<Content><![CDATA[{$sendText}]]></Content>
						</xml>
TTTTT;
					return $echostr;

				}else if($EventKey == "sendImage"){

					// $sendText = "发送图片测试";
					$MediaId = "m-VeMfWr_X7wApz23Qe_4L2ISHhQhih7hN5AfXA8k8n0bgdM0nvyz3ybfNZt0uJs";
					$time = time();
					$echostr = <<<TTTTT
						<xml>
						<ToUserName><![CDATA[{$FromUserName}]]></ToUserName>
						<FromUserName><![CDATA[{$ToUserName}]]></FromUserName>
						<CreateTime>{$time}</CreateTime>
						<MsgType><![CDATA[image]]></MsgType>
						<Image>
						<MediaId><![CDATA[{$MediaId}]]></MediaId>
						</Image>
						</xml>
TTTTT;
					return $echostr;

				}else if($EventKey == "sendVoice"){

				}
				break;

			default:
				echo "";
				break;
		}
	}
 ?>