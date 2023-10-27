-- 
-- 
-- SQL-UPDATE
--
-- 
-- 30-05-2023
INSERT INTO `status` (`id`, `name`, `alias`) VALUES ('14', 'Is draft', 'draft');
--
-- 
-- 05-06-2023
ALTER TABLE `companies` ADD COLUMN `code_pin` VARCHAR(12) NULL DEFAULT '0000' AFTER `can_dinein`;
--
-- 
-- 29-06-2023
ALTER TABLE `items`
	ADD COLUMN `product_id_hiboutik` BIGINT(20) NULL DEFAULT NULL AFTER `discounted_price`;

--
-- 
-- 05-07-2023
UPDATE `items` SET `product_id_hiboutik`=1 WHERE  `id`=341;
UPDATE `items` SET `product_id_hiboutik`=2 WHERE  `id`=342;
-- 343 pas de produit similaire sur hiboutik
UPDATE `items` SET `product_id_hiboutik`=252 WHERE  `id`=344;
UPDATE `items` SET `product_id_hiboutik`=133 WHERE  `id`=345;
UPDATE `items` SET `price`=11, `product_id_hiboutik`=6 WHERE  `id`=346;
-- 347 pas de produit similaire sur hiboutik
UPDATE `items` SET `product_id_hiboutik`=7 WHERE  `id`=348;
UPDATE `items` SET `product_id_hiboutik`=8 WHERE  `id`=349;
UPDATE `items` SET `product_id_hiboutik`=9 WHERE  `id`=350;
UPDATE `items` SET `price`=4, `product_id_hiboutik`=10, `deleted_at`='2023-07-04 12:05:11' WHERE  `id`=351;
-- 352 pas de produit similaire sur hiboutik
--
-- 
-- 10-07-2023
UPDATE `items` SET `price`=2.5, `product_id_hiboutik`=12 WHERE  `id`=353;
-- 354 pas de produit similaire sur hiboutik
UPDATE `items` SET `product_id_hiboutik`=171 WHERE  `id`=355;
UPDATE `items` SET `price`=12, `product_id_hiboutik`=126 WHERE  `id`=356;
UPDATE `items` SET `product_id_hiboutik`=97 WHERE  `id`=357;
UPDATE `items` SET `price`=10, `product_id_hiboutik`=101 WHERE  `id`=358;
UPDATE `items` SET `product_id_hiboutik`=239 WHERE  `id`=359;
UPDATE `items` SET `product_id_hiboutik`=124 WHERE  `id`=360;
UPDATE `items` SET `price`=11.5, `product_id_hiboutik`=89 WHERE  `id`=361;
UPDATE `items` SET `price`=11.5, `product_id_hiboutik`=88 WHERE  `id`=362;
UPDATE `items` SET `price`=7, `product_id_hiboutik`=109 WHERE  `id`=363;
UPDATE `items` SET `price`=7, `product_id_hiboutik`=109 WHERE  `id`=364;
UPDATE `items` SET `price`=1, `product_id_hiboutik`=27 WHERE  `id`=365;
UPDATE `items` SET `price`=2, `product_id_hiboutik`=119 WHERE  `id`=366;
UPDATE `items` SET `price`=4.5, `product_id_hiboutik`=118 WHERE  `id`=367;
-- 368 pas de produit similaire sur hiboutik
-- 369 pas de produit similaire sur hiboutik
-- 370 pas de produit similaire sur hiboutik
UPDATE `items` SET `price`=3, `product_id_hiboutik`=131 WHERE  `id`=371;
UPDATE `items` SET `price`=4.5, `product_id_hiboutik`=131 WHERE  `id`=372;

--
-- 
-- 23-08-2023
ALTER TABLE `orders`
	ADD COLUMN `sale_id_hiboutik` BIGINT NULL DEFAULT NULL AFTER `kds_finished`;