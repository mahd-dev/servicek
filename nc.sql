ALTER TABLE  `user` ADD  `reset_password_token` VARCHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER  `seen_new_pages_until` ;
ALTER TABLE  `user` ADD  `e-mail_validation_token` VARCHAR( 36 ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL AFTER  `reset_password_token` ;
