<?php
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
		$echostr = <<<VVVVV
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
VVVVV;
		return $echostr;
	}
 ?>











