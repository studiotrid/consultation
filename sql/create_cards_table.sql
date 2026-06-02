-- SQL for Cards Module
-- Table to store drawn cards for each consultation

CREATE TABLE IF NOT EXISTS `consultation_cards` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `consultation_id` INT(11) NOT NULL,
  `user_id` INT(11) NOT NULL,
  `day_number` INT(11) NOT NULL COMMENT 'Day 1-28',
  `card_date` DATE NOT NULL COMMENT 'The specific date for this card',
  `card_number` INT(11) DEFAULT NULL COMMENT 'Card number 1-100, NULL if not yet drawn',
  `experience` TEXT DEFAULT NULL COMMENT 'User experience for this card',
  `drawn_at` DATETIME DEFAULT NULL COMMENT 'When the card was drawn',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_card` (`consultation_id`, `day_number`),
  KEY `user_consultation` (`user_id`, `consultation_id`),
  KEY `card_date` (`card_date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add cards field to konsultacije table if it doesn't exist
ALTER TABLE `konsultacije` 
ADD COLUMN `cards` DATE DEFAULT NULL COMMENT 'Start date for cards module' AFTER `iskustvo`;
