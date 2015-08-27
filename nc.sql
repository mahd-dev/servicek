ALTER TABLE  `user` ADD  `seen_new_pages_until` TIMESTAMP NULL AFTER  `mobile` ;
UPDATE  `user` SET  `seen_new_pages_until` = NOW( ) where `type` = 'master';
