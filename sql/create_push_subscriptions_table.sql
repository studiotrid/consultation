-- Push Subscriptions Table
-- This table stores push notification subscriptions for users

CREATE TABLE IF NOT EXISTS `push_subscriptions` (
    `id` INT AUTO_INCREMENT PRIMARY KEY COMMENT 'Unique subscription ID',
    `user_id` INT DEFAULT NULL COMMENT 'User ID (korisnici table)',
    `coach_id` INT DEFAULT NULL COMMENT 'Coach ID (coach table)',
    `endpoint` TEXT NOT NULL COMMENT 'Push service endpoint URL',
    `auth_key` VARCHAR(255) DEFAULT NULL COMMENT 'Authentication key',
    `p256dh_key` TEXT DEFAULT NULL COMMENT 'P256dh public key',
    `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP COMMENT 'When subscription was created',
    `last_updated` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last time subscription was updated',
    UNIQUE KEY `unique_endpoint` (`endpoint`(255)) COMMENT 'Ensure each device has only one subscription',
    KEY `user_id` (`user_id`) COMMENT 'Index for user lookups',
    KEY `coach_id` (`coach_id`) COMMENT 'Index for coach lookups'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Stores Web Push notification subscriptions';

-- Optional: Add foreign key constraints if you want referential integrity
-- Uncomment the lines below if your korisnici and coach tables exist

-- ALTER TABLE `push_subscriptions`
--     ADD CONSTRAINT `fk_push_user_id` 
--     FOREIGN KEY (`user_id`) REFERENCES `korisnici`(`id`) 
--     ON DELETE CASCADE;

-- ALTER TABLE `push_subscriptions`
--     ADD CONSTRAINT `fk_push_coach_id` 
--     FOREIGN KEY (`coach_id`) REFERENCES `coach`(`id`) 
--     ON DELETE CASCADE;

-- Query to check existing subscriptions
-- SELECT * FROM push_subscriptions ORDER BY last_updated DESC;

-- Query to get user subscriptions
-- SELECT * FROM push_subscriptions WHERE user_id = 1;

-- Query to get coach subscriptions
-- SELECT * FROM push_subscriptions WHERE coach_id = 1;

-- Query to delete old subscriptions (older than 90 days with no updates)
-- DELETE FROM push_subscriptions WHERE last_updated < DATE_SUB(NOW(), INTERVAL 90 DAY);
