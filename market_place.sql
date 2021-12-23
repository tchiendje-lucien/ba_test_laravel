-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 19 déc. 2021 à 18:06
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `market_place`
--

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images_pub`
--

CREATE TABLE `images_pub` (
  `ID_IMAGE` int(11) NOT NULL,
  `ID_PUBLICATION` int(11) NOT NULL,
  `LIBELLE_IMAGE` char(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `images_pub`
--

INSERT INTO `images_pub` (`ID_IMAGE`, `ID_PUBLICATION`, `LIBELLE_IMAGE`) VALUES
(4, 4, '61bf658eaf4fb.jpg'),
(5, 5, '61bf65a826042.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2021_12_18_024746_create_images_pub_table', 1),
(5, '2021_12_18_024746_create_produits_table', 1),
(6, '2021_12_18_024746_create_publications_table', 1),
(7, '2021_12_18_024746_create_users_table', 1),
(8, '2021_12_18_024747_add_foreign_keys_to_images_pub_table', 1),
(9, '2021_12_18_024747_add_foreign_keys_to_publications_table', 1),
(10, '2021_12_19_170505_create_failed_jobs_table', 0),
(11, '2021_12_19_170505_create_images_pub_table', 0),
(12, '2021_12_19_170505_create_password_resets_table', 0),
(13, '2021_12_19_170505_create_personal_access_tokens_table', 0),
(14, '2021_12_19_170505_create_produits_table', 0),
(15, '2021_12_19_170505_create_publications_table', 0),
(16, '2021_12_19_170505_create_users_table', 0),
(17, '2021_12_19_170506_add_foreign_keys_to_images_pub_table', 0),
(18, '2021_12_19_170506_add_foreign_keys_to_publications_table', 0);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `ID_PRODUIT` int(11) NOT NULL,
  `NOM_PROD` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PRIX_PROD` decimal(10,2) NOT NULL,
  `DESC_PRODUIT` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ETAT_STOCK` tinyint(1) NOT NULL,
  `DATE_CREATE` datetime NOT NULL,
  `DATE_UPDATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`ID_PRODUIT`, `NOM_PROD`, `PRIX_PROD`, `DESC_PRODUIT`, `ETAT_STOCK`, `DATE_CREATE`, `DATE_UPDATE`) VALUES
(9, 'CD Porno', '500.00', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error consequuntur itaque eius fuga molestiae rem sint, dignissimos voluptas sapiente. Laboriosam, reprehenderit exercitationem? Nesciunt voluptas, officia sit mollitia distinctio impedit cumque.', 1, '2021-12-19 17:02:06', '2021-12-19 17:02:06'),
(10, 'Savon ccc', '300.00', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Error consequuntur itaque eius fuga molestiae rem sint, dignissimos voluptas sapiente. Laboriosam, reprehenderit exercitationem? Nesciunt voluptas, officia sit mollitia distinctio impedit cumque.', 1, '2021-12-19 17:02:32', '2021-12-19 17:02:32');

-- --------------------------------------------------------

--
-- Structure de la table `publications`
--

CREATE TABLE `publications` (
  `ID_PUBLICATION` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_PRODUIT` int(11) NOT NULL,
  `ETAT_PUB` tinyint(1) NOT NULL,
  `DATE_PUB` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DATE_MODIF_PUB` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `publications`
--

INSERT INTO `publications` (`ID_PUBLICATION`, `ID_USER`, `ID_PRODUIT`, `ETAT_PUB`, `DATE_PUB`, `DATE_MODIF_PUB`) VALUES
(4, 1, 9, 1, '2021-12-19 17:02:06', '2021-12-19 17:02:06'),
(5, 1, 10, 1, '2021-12-19 17:02:32', '2021-12-19 17:02:32');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `ID_USER` int(11) NOT NULL,
  `EMAIL` char(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FULL_NAME` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ETAT_USER` int(11) NOT NULL,
  `PHOTO_USER` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `DATE_CREATE` datetime NOT NULL,
  `DATE_UPDATE` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_USER`, `EMAIL`, `PASSWORD`, `FULL_NAME`, `ETAT_USER`, `PHOTO_USER`, `DATE_CREATE`, `DATE_UPDATE`) VALUES
(1, 'luciendidier@gmail.com', '$2y$10$Z4ODB1MvvGyYI6Ns688NGOSFHXFThnj/bsYBRryHg35wQybW8Tzb2', 'Lucien Didier', 1, 'UserPhote.png', '2021-12-18 19:50:24', '2021-12-18 19:50:24');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `images_pub`
--
ALTER TABLE `images_pub`
  ADD PRIMARY KEY (`ID_IMAGE`),
  ADD KEY `I_FK_IMAGES_PUB_PUBLICATIONS` (`ID_PUBLICATION`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`ID_PRODUIT`);

--
-- Index pour la table `publications`
--
ALTER TABLE `publications`
  ADD PRIMARY KEY (`ID_PUBLICATION`),
  ADD KEY `I_FK_PUBLICATIONS_USERS` (`ID_USER`),
  ADD KEY `I_FK_PUBLICATIONS_PRODUITS` (`ID_PRODUIT`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_USER`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images_pub`
--
ALTER TABLE `images_pub`
  MODIFY `ID_IMAGE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `ID_PRODUIT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `publications`
--
ALTER TABLE `publications`
  MODIFY `ID_PUBLICATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `images_pub`
--
ALTER TABLE `images_pub`
  ADD CONSTRAINT `FK_IMAGES_PUB_PUBLICATIONS` FOREIGN KEY (`ID_PUBLICATION`) REFERENCES `publications` (`ID_PUBLICATION`);

--
-- Contraintes pour la table `publications`
--
ALTER TABLE `publications`
  ADD CONSTRAINT `FK_PUBLICATIONS_PRODUITS` FOREIGN KEY (`ID_PRODUIT`) REFERENCES `produits` (`ID_PRODUIT`),
  ADD CONSTRAINT `FK_PUBLICATIONS_USERS` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
