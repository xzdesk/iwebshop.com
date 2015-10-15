<?php
/**
 * @copyright (c) 2015 aircheng.com
 * @file hsms.php
 * @brief 短信发送接口
 * @author nswe
 * @date 2015/5/30 16:23:21
 * @version 3.3
 */

 /**
 * @class Hsms
 * @brief 短信发送接口
 */
class Hsms
{
	private static $smsInstance = null;

	/**
	 * @brief 获取config用户配置
	 * @return array
	 */
	private static function getPlatForm()
	{
		$siteConfigObj = new Config("site_config");
		return $siteConfigObj->sms_platform;
	}

	/**
	 * @brief 发送短信
	 * @param string $mobile
	 * @param string $content
	 * @return success or fail
	 */
	public static function send($mobile,$content)
	{
		if(self::$smsInstance == null)
		{
			$platform = self::getPlatForm();
			switch($platform)
			{
				case "zhutong":
				{
					$classFile = IWeb::$app->getBasePath().'plugins/hsms/zhutong.php';
					require($classFile);
					self::$smsInstance = new zhutong();
				}
				break;

				default:
				{
					$classFile = IWeb::$app->getBasePath().'plugins/hsms/haiyan.php';
					require($classFile);
					self::$smsInstance = new haiyan();
				}
			}
		}

		if(IValidate::mobi($mobile) && $content)
		{
			$ip = IClient::getIp();
			if($ip)
			{
				$mobileKey = md5($mobile.$ip);
				$sendTime  = ISession::get($mobileKey);
				if($sendTime && time() - $sendTime < 60)
				{
					return false;
				}
				ISession::set($mobileKey,time());
				return self::$smsInstance->send($mobile,$content);
			}
		}
		return false;
	}
}

/**
 * @brief 短信抽象类
 */
abstract class hsmsBase
{
	//短信发送接口
	abstract public function send($mobile,$content);

	//短信发送结果接口
	abstract public function response($result);

	//短信配置参数
	abstract public function getParam();
}