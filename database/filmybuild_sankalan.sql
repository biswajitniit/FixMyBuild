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
