-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 13, 2023 alle 18:08
-- Versione del server: 10.4.22-MariaDB
-- Versione PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courseitadb`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `course`
--

CREATE TABLE `course` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `macroarea` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `professor_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `course`
--

INSERT INTO `course` (`id`, `title`, `macroarea`, `info`, `professor_id`) VALUES
(2, 'Rerum.', 'Business', 'Quaerat assumenda molestiae voluptatum error rerum odio omnis dicta et saepe.', 1),
(3, 'Inventore rem quia quas vero.', 'Business', 'Facere distinctio voluptates consectetur.', 1),
(4, 'Et ducimus ea quas.', 'Arts', 'Et quam reprehenderit ut incidunt rerum.', 1),
(7, 'Dolor nesciunt veritatis fugiat dolorem.', 'Business', 'Incidunt ut alias et saepe nihil sit magni sint.', 1),
(8, 'Sapiente officiis corrupti.', 'Science', 'Ducimus porro velit rem dolores excepturi ab.', 1),
(9, 'Est ut.', 'Other', 'Deserunt aliquid consequatur nulla quasi.', 1),
(10, 'Repudiandae.', 'Humanities', 'Ut.', 1),
(11, 'Spagnolo', 'Humanities', 'Corso per insegnare spagnolo', 1),
(12, 'Corso di cucito', 'Other', 'Nuovo corso di cucito per principianti.', 2),
(13, 'Corso di inglese', 'Education', 'Nuovo corso di inglese per principianti.', 2),
(14, 'Anatomia umana', 'Science', 'Nuovo corso di anatomia umana!', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `course_student`
--

CREATE TABLE `course_student` (
  `id` int(10) UNSIGNED NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `course_student`
--

INSERT INTO `course_student` (`id`, `course_id`, `student_id`) VALUES
(1, 3, 1),
(2, 10, 1),
(4, 7, 2),
(5, 8, 2),
(6, 7, 3),
(7, 10, 4),
(8, 10, 5),
(9, 3, 6),
(10, 9, 6),
(12, 11, 7),
(13, 14, 1),
(14, 14, 11);

-- --------------------------------------------------------

--
-- Struttura della tabella `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2022_10_10_165429_create_students_table', 1),
(3, '2022_10_10_165504_create_professors_table', 1),
(4, '2022_10_10_165558_create_courses_table', 1),
(5, '2022_10_10_165618_create_courses_students_table', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `professor`
--

CREATE TABLE `professor` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `career` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `professor`
--

INSERT INTO `professor` (`id`, `username`, `email`, `password`, `name`, `surname`, `career`) VALUES
(1, 'devis', 'devis.bianchini@unibs.it', 'ac37cc7b0522255023ea8d3be237d698', 'Devis', 'Bianchini', 'Professore presso Università degli Studi di Brescia.'),
(2, 'angiolettarubetti', 'angioletta.rubetti@hotmail.it', '0fe4f43e1dd173abc07ce508a74800e2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `student`
--

CREATE TABLE `student` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `surname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dump dei dati per la tabella `student`
--

INSERT INTO `student` (`id`, `username`, `email`, `password`, `name`, `surname`) VALUES
(1, 'giovanni', 'g.baselli@unibs.it', '0fe4f43e1dd173abc07ce508a74800e2', 'Giovanni', 'Baselli'),
(2, 'bcrona', 'felix.kirlin@yahoo.com', '99e14202a183189b6f79aefc45df1a69', 'Johann Roob', 'Hills'),
(3, 'flavio06', 'okuhlman@prohaska.biz', '180e5f6b0a4872e8b1b84adbb981a550', 'Dr. Rogelio Langworth DDS', 'Kertzmann'),
(4, 'hessel.stephen', 'leola16@yahoo.com', 'fb3c64a9d52e31eaa85e6125a3797e89', 'Prof. Alana Cummerata', 'Kilback'),
(5, 'dubuque.adeline', 'streich.fritz@hotmail.com', '10e383782b9a7cb3e02e75ce0325e768', 'Ashton Reilly', 'Lockman'),
(6, 'frowe', 'anissa.leannon@stroman.com', '268900f7d0fc773196c5fd718239aa7d', 'Miss Tierra Glover', 'Hermann'),
(7, 'sofia', 'sofy.maffeis.sm@gmail.com', '0fe4f43e1dd173abc07ce508a74800e2', NULL, NULL),
(8, 'marcomengoni', 'marco.mengoni@gmail.com', '0fe4f43e1dd173abc07ce508a74800e2', NULL, NULL),
(9, 'noemi', 'noemi.terenziani@gmail.com', '0fe4f43e1dd173abc07ce508a74800e2', NULL, NULL),
(11, 'paolo', 'paolo@hotmail.com', '0fe4f43e1dd173abc07ce508a74800e2', NULL, NULL),
(12, 'giorgio', 'giorgio@hotmail.it', '0fe4f43e1dd173abc07ce508a74800e2', NULL, NULL);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_professor_id_foreign` (`professor_id`);

--
-- Indici per le tabelle `course_student`
--
ALTER TABLE `course_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_student_course_id_foreign` (`course_id`),
  ADD KEY `course_student_student_id_foreign` (`student_id`);

--
-- Indici per le tabelle `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indici per le tabelle `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `professor_username_unique` (`username`),
  ADD UNIQUE KEY `professor_email_unique` (`email`);

--
-- Indici per le tabelle `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_username_unique` (`username`),
  ADD UNIQUE KEY `student_email_unique` (`email`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `course_student`
--
ALTER TABLE `course_student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `professor`
--
ALTER TABLE `professor`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `student`
--
ALTER TABLE `student`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_professor_id_foreign` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`id`);

--
-- Limiti per la tabella `course_student`
--
ALTER TABLE `course_student`
  ADD CONSTRAINT `course_student_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`),
  ADD CONSTRAINT `course_student_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
