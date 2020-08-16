INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'vitoto9010', 'vitorama98@gmail.com', NULL, '$2y$10$dIsJKrScH/QSEWEXI11r7uRn4V3xn3k4dOgNP31E8LEojZ1vCfQbu', NULL, '2020-08-13 06:47:05', '2020-08-13 06:47:05'),
(2, 'user2', 'user@mail.com', NULL, '$2y$10$OEt9O4FT/RVLn5pqb/khu.11TqydLFmGZJrpOcTql0tGhxiSMEbGe', 's4QpHbe7PnXo5YFi8y77gdEs8FUBYsOwLLlThBSIGYItHKPrI3QgMk41dwdo', '2020-08-13 06:47:21', '2020-08-13 06:47:21');

INSERT INTO `profiles` (`id`, `full_name`, `phone`, `photo`, `user_id`, `created_at`, `updated_at`) VALUES (NULL, 'Vito Ramadhan', '213123', 'img/avatar.jpg', '1', NULL, NULL), (NULL, 'User def 2', '12343', 'img/avatar2.png', '2', NULL, NULL)