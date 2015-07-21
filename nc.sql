ALTER TABLE  `company` ADD  `requests` BIGINT NULL DEFAULT  '0' AFTER  `cover` ;
ALTER TABLE  `shop` ADD  `requests` BIGINT NULL DEFAULT  '0' AFTER  `email` ;
ALTER TABLE  `job` ADD  `requests` BIGINT NULL DEFAULT  '0' AFTER  `email` ;
