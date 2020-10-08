<?php
//xml模板的一个类
class Xml{
	public static $xml=[
			'title'=>'<xml>
			    <ToUserName><![CDATA[%s]]></ToUserName>
				<FromUserName><![CDATA[%s]]></FromUserName>
				<CreateTime>%s</CreateTime>',
			'image'=>'
				<MsgType><![CDATA[image]]></MsgType>
				<Image>
				<MediaId><![CDATA[%s]]></MediaId>
				</Image>
				</xml>',
			'text'=>'<MsgType><![CDATA[text]]></MsgType>
				<Content><![CDATA[%s]]></Content>
				</xml>',
			'voice'=>'<MsgType><![CDATA[voice]]></MsgType>
				<Voice>
				<MediaId><![CDATA[%s]]></MediaId>
				</Voice>
				</xml>',
			'music'=>'<MsgType><![CDATA[music]]></MsgType>
				<Music>
				<Title><![CDATA[%s]]></Title>
				<Description><![CDATA[%s]]></Description>
				<MusicUrl><![CDATA[%s]]></MusicUrl>
				<HQMusicUrl><![CDATA[%s]]></HQMusicUrl>
				<ThumbMediaId><![CDATA[%s]]></ThumbMediaId>
				</Music>
				</xml>',
			'news_item'=>'<item>
                <Title><![CDATA[%s]]></Title> 
                <Description><![CDATA[%s]]></Description>
                <PicUrl><![CDATA[%s]]></PicUrl>
                <Url><![CDATA[%s]]></Url>
                </item>',
            'news'=>'<MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>%s</ArticleCount>
                <Articles>
                %s
                </Articles>
                </xml>',
            'custom'=>'<MsgType><![CDATA[transfer_customer_service]]></MsgType>
                </xml>'
	];

	

	/**
	 * [getXml  得到xml ]
	 * @param  [type] $key [数组的键]
	 * @return [type]      [xml]
	 */
	public static function getXml($key){
 			if(isset(self::$xml[$key])){
 				 return self::$xml[$key];
 			}
 			return '';	
	 	 }


	public  function getUrl(){



	} 
		 
	}
