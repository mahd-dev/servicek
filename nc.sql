CREATE TABLE `job_cv` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_job` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`title`, `description`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;

CREATE TABLE `job_cv_item` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cv` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_from` timestamp NULL DEFAULT NULL,
  `date_to` timestamp NULL DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`title`, `description`, `at`, `location`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;

CREATE TABLE `job_cv_item_project` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_cv_item` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`title`, `description`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;

CREATE TABLE `job_skill` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `id_job` bigint(20) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(1023) COLLATE utf8_unicode_ci DEFAULT NULL,
  `percent` INT DEFAULT 0,
  `creation_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `name` (`title`, `description`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=1 DELAY_KEY_WRITE=1;
