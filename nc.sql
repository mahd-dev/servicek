CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_job` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`,`description`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1 AUTO_INCREMENT=1 ;

ALTER TABLE `category` ADD `portfolio` TINYINT(1) NULL AFTER `product` ;
