DROP TABLE IF EXISTS `order_tracking_app`;
CREATE TABLE `order_tracking_app` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rider_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `rider_lat` text COLLATE utf8_unicode_ci NOT NULL,
  `rider_lng` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` date NOT NULL,
  primary key (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `user_notifications_app`;
CREATE TABLE `user_notifications_app` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fcm_token` longtext COLLATE utf8mb4_unicode_ci,
  `device_id` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  primary key (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;