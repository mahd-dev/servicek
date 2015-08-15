CREATE TABLE IF NOT EXISTS `locality` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_parent` bigint(20) DEFAULT NULL,
  `short_name` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `long_name` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`long_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1 AUTO_INCREMENT=1 ;

ALTER TABLE  `company_seat` ADD  `id_locality` BIGINT NULL AFTER  `geolocation` ;
ALTER TABLE  `job` ADD  `id_locality` BIGINT NULL AFTER  `geolocation` ;
ALTER TABLE  `shop` ADD  `id_locality` BIGINT NULL AFTER  `geolocation` ;


UPDATE `locality` SET `id_parent`='1' WHERE `id_parent`='281' or `id_parent`='62' or `id_parent`='331' or `id_parent`='251' or `id_parent`='164' or `id_parent`='219' or `id_parent`='120';
delete from `locality` WHERE `id`='281' or `id`='62' or `id`='331' or `id`='251' or `id`='164' or `id`='219' or `id`='120';
