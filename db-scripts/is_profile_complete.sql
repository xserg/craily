ALTER TABLE `tbl_members` ADD `is_profile_complete` BOOLEAN NOT NULL DEFAULT FALSE AFTER `highest_level_of_education`;
UPDATE `tbl_members` SET `is_profile_complete` = '1';