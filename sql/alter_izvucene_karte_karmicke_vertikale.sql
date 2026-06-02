-- Prosirenje tabele izvucene_karte za snimanje odgovora i komentara
-- iz testa modula Aktiviranje karmickih vertikala

ALTER TABLE `izvucene_karte`
    ADD COLUMN `kv_odgovor1` TINYINT(3) UNSIGNED NULL AFTER `procenat`,
    ADD COLUMN `kv_odgovor2` TINYINT(3) UNSIGNED NULL AFTER `kv_odgovor1`,
    ADD COLUMN `kv_odgovor3` TINYINT(3) UNSIGNED NULL AFTER `kv_odgovor2`,
    ADD COLUMN `kv_procenat` TINYINT(3) UNSIGNED NULL AFTER `kv_odgovor3`,
    ADD COLUMN `kv_komentar` TEXT NULL AFTER `kv_procenat`,
    ADD COLUMN `kv_testirano_at` DATETIME NULL AFTER `kv_komentar`;
