-- Prosirenje tabele izvucene_karte za cuvanje odgovora i komentara
-- iz Kosmicka poruka dnevnog testa (popup nakon otvaranja karte)

ALTER TABLE `izvucene_karte`
    ADD COLUMN `kp_odgovor1` TINYINT(3) UNSIGNED NULL AFTER `procenat`,
    ADD COLUMN `kp_odgovor2` TINYINT(3) UNSIGNED NULL AFTER `kp_odgovor1`,
    ADD COLUMN `kp_odgovor3` TINYINT(3) UNSIGNED NULL AFTER `kp_odgovor2`,
    ADD COLUMN `kp_komentar` TEXT NULL AFTER `kp_odgovor3`,
    ADD COLUMN `kp_testirano_at` DATETIME NULL AFTER `kp_komentar`;
