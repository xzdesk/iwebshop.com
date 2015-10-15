<?php
/**
 * @brief 升级更新控制器
 */
class Update extends IController
{
	/**
	 * @brief iwebshop15090900 版本升级更新
	 */
	public function iwebshop15090900()
	{
		$sql = array(
			"ALTER TABLE `{pre}category` ADD `seller_id` int(11) unsigned  NOT NULL COMMENT '商家ID'",
			"ALTER TABLE `{pre}ticket` ADD `seller_id` int(11) unsigned  NOT NULL COMMENT '商家ID'",
			"ALTER TABLE `{pre}prop` ADD `seller_id` int(11) unsigned  NOT NULL COMMENT '商家ID'",
			"ALTER TABLE `{pre}order_goods` ADD `seller_id` int(11) unsigned  NOT NULL COMMENT '商家ID'",
			"ALTER TABLE `{pre}promotion` ADD `seller_id` int(11) unsigned  NOT NULL COMMENT '商家ID'",
			"ALTER TABLE `{pre}bill` ADD `order_ids` text COMMENT 'order表主键ID，结算的ID'",
			"ALTER TABLE `{pre}order` ADD `seller_id` int(11) unsigned  NOT NULL COMMENT '商家ID'",
			"ALTER TABLE `{pre}order` ADD `is_checkout` tinyint(1) NOT NULL default '0' COMMENT '是否给商家结算货款 0:未结算;1:已结算'",
		);

		foreach($sql as $key => $val)
		{
			$val = str_replace('{pre}',IWeb::$app->config['DB']['tablePre'],$val);
			IDBFactory::getDB()->query($val);
		}
		die('升级成功！');
	}
}