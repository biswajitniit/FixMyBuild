--
-- Table structure for table `project_categories`
--

CREATE TABLE `project_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `project_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `project_categories_project_id_foreign` (`project_id`),
  ADD KEY `project_categories_sub_category_id_foreign` (`sub_category_id`);

--
-- AUTO_INCREMENT for table `project_categories`
--
ALTER TABLE `project_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for table `project_categories`
--
ALTER TABLE `project_categories`
  ADD CONSTRAINT `project_categories_project_id_foreign` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_categories_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `buildersubcategories` (`id`) ON DELETE CASCADE;

--
-- Change Status Column From Enum to Varchar on projects table
--
ALTER TABLE `projects` CHANGE `status` `status` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'submitted_for_review' COMMENT 'submitted_for_review,returned_for_review,estimation,project_started,awaiting_your_review';

--
-- Add Nullable Fields to estimates table
--

ALTER TABLE `estimates` CHANGE `contingency` `contingency` VARCHAR(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `initial_payment` `initial_payment` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `total_time` `total_time` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `total_time_type` `total_time_type` VARCHAR(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL, CHANGE `terms_and_conditions` `terms_and_conditions` TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;


--
-- Modify file_original_name field of project_estimate_files to NULL
--

ALTER TABLE `project_estimate_files` CHANGE `file_original_name` `file_original_name` VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL;

--
-- ADD column county, town after sub_area_cover_id in tradersarea
--
ALTER TABLE `traderareas` ADD `county` VARCHAR(255) NOT NULL COMMENT 'areas' AFTER `sub_area_cover_id`, ADD `town` VARCHAR(255) NOT NULL COMMENT 'sub_areas' AFTER `county`;

--
-- ADD Indexing to county town in traderareas
--
ALTER TABLE `traderareas` ADD INDEX(`county`, `town`);

--
-- CREATE VIEW county_towns
--
CREATE VIEW county_towns AS SELECT DISTINCT `Post Town` AS county, `Dependent Locality` AS town FROM `postcodes`;

-- CREATE VIEW id_county_town AS SELECT ROW_NUMBER() OVER() AS id, `Post Town` AS county, `Dependent Locality` AS town FROM `postcodes` GROUP BY `Post Town`, `Dependent Locality` ORDER BY 'id';

--
-- CHANGE sub_area_cover_id OF TRADER_AREAS TO NULL
--
ALTER TABLE `traderareas` CHANGE `sub_area_cover_id` `sub_area_cover_id` BIGINT(20) UNSIGNED NULL;

--
-- ADD UNIQUE ON COMPOSITE KEY (email, deleted_at) instead of email
--
--ALTER TABLE `users` DROP INDEX `users_email_unique`;
--ALTER TABLE users ADD CONSTRAINT unique_email_deleted_at UNIQUE (email, deleted_at);
