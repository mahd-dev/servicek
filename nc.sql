DardouriMohamed 12/07/2015 04:08

ALTER TABLE  `product` CHANGE  `id_company`  `id_page` BIGINT( 20 ) NULL DEFAULT NULL ;
ALTER TABLE  `product` ADD  `page_type` VARCHAR( 15 ) NULL AFTER  `id_page` ;
UPDATE product SET page_type = 'company';

ALTER TABLE  `service` CHANGE  `id_company`  `id_page` BIGINT( 20 ) NULL DEFAULT NULL ;
ALTER TABLE  `service` ADD  `page_type` VARCHAR( 15 ) NULL AFTER  `id_page` ;
UPDATE service SET page_type = 'company';

ALTER TABLE  `offer` CHANGE  `id_company`  `id_page` BIGINT( 20 ) NULL DEFAULT NULL ;
ALTER TABLE  `offer` ADD  `page_type` VARCHAR( 15 ) NULL AFTER  `id_page` ;
UPDATE offer SET page_type = 'company';

CREATE TABLE `shop` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_admin` bigint(20) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cover` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(4095) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `geolocation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`name`),
  FULLTEXT KEY `description` (`description`,`address`,`tel`,`mobile`,`email`),
  FULLTEXT KEY `name_2` (`name`,`description`,`address`,`tel`,`mobile`,`email`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;

ALTER TABLE  `job` ADD  `url` VARCHAR( 127 ) NULL AFTER  `description` ;

ALTER TABLE  `category` ADD  `shop_publish_price` FLOAT NULL AFTER  `company_publish_price` ;
UPDATE category SET shop_publish_price='50';
