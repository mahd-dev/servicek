ALTER TABLE  `category` ADD  `id_parent` BIGINT NULL AFTER  `id` ;
ALTER TABLE  `category` ADD  `service` BOOLEAN NULL AFTER  `job_publish_price` ;
ALTER TABLE  `category` ADD  `product` BOOLEAN NULL AFTER  `service` ;
