
--
-- Database: `visitors`
--
CREATE DATABASE IF NOT EXISTS `visitors` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_slovenian_ci;
USE `visitors`;
-- --------------------------------------------------------

--
-- Table structure for table `tbl_visitors`
--

CREATE TABLE `tbl_first_visit` (
  `id` int NOT NULL,
  `id_ip_strlen` bigint DEFAULT NULL,
  `date_visit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `os` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `browser` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `request_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `free_5` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `free_6` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;




CREATE TABLE `tbl_visitors` (
  `id` int NOT NULL,
  `date_visit` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `os` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `browser` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `request_url` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `free_5` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `free_6` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL,
  `id_ip_strlen` bigint DEFAULT NULL,
  `ip_address` varchar(100) CHARACTER SET utf8 COLLATE utf8_slovenian_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovenian_ci;


ALTER TABLE `tbl_first_visit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ip_strlen` (`id_ip_strlen`);



ALTER TABLE `tbl_visitors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_ip_strlen` (`id_ip_strlen`);


ALTER TABLE `tbl_first_visit`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `tbl_visitors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;


ALTER TABLE `tbl_visitors`
  ADD CONSTRAINT `tbl_visitors_ibfk_1` FOREIGN KEY (`id_ip_strlen`) REFERENCES `tbl_first_visit` (`id_ip_strlen`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
