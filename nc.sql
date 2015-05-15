ALTER TABLE `category` ADD `publish_price` FLOAT NULL AFTER `name`;
ALTER TABLE `category` CHANGE `publish_price` `company_publish_price` FLOAT NULL DEFAULT NULL;
ALTER TABLE `category` ADD `job_publish_price` FLOAT NULL AFTER `company_publish_price`;
UPDATE `category` SET `company_publish_price`=90,`job_publish_price`=30;