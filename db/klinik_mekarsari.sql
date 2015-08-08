-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2015 at 10:17 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `klinik_mekarsari`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `p_reset_trans`()
BEGIN

	DELETE FROM t_transfers;
    DELETE FROM t_receipts;
    DELETE FROM `t_purchases_receipts`;
    DELETE FROM `t_purchases`;
    DELETE FROM `t_purchases_requisitions`;

    DELETE FROM sys_activities;
    DELETE FROM `t_stocks_journals`;
    
    COMMIT;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `p_suppliers_compare`()
BEGIN

		SET @sql = NULL;

		SET @@group_concat_max_len = 5000;

		SELECT

				GROUP_CONCAT(DISTINCT

						CONCAT(

								'MAX(IF(mi_msp_id = ''',

								mi_msp_id,

								''', mi_price, NULL)) AS ',

								LOWER(REPLACE(REPLACE(mi_msp_name, ' ', '_'), '.', ''))

						)

				) INTO @sql

		FROM v_suppliers_items;



		SET @sql = CONCAT(

				'SELECT mi_id, mi_code, mi_name, ',

				@sql,


				' ',


				'FROM v_suppliers_items ',

				'GROUP BY mi_id'

		);

		

		SELECT @sql;



		PREPARE stmt FROM @sql;

		EXECUTE stmt;

		DEALLOCATE PREPARE stmt;

END$$

--
-- Functions
--
CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_picklist_qty`(
        `v_tps_id` INTEGER(11)
    ) RETURNS int(11)
BEGIN
	DECLARE v_qty INT(11) DEFAULT 0;
    DECLARE v_children INT(11) DEFAULT 0;
    
    SELECT COUNT(tps_id) INTO v_children 
    FROM t_picklist_smartcard
    WHERE tps_pid = v_tps_id;
    
    IF v_children > 0 THEN
    	SELECT SUM(tps_qty) INTO v_qty

        FROM t_picklist_smartcard
        WHERE tps_pid = v_tps_id;
    ELSE
    	SELECT tps_qty INTO v_qty
        FROM t_picklist_smartcard
        WHERE tps_id = v_tps_id;
    END IF;
    
    RETURN v_qty;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_requisition_approval`(
        `v_tpr_no` VARCHAR(50)
    ) RETURNS int(1)
BEGIN
	DECLARE v_status INT(1) DEFAULT 0;
	

    SELECT 
		(SUM(token) = SUM(approved) AND SUM(approved) > 0) INTO v_status
	FROM (
      SELECT 
          1 as token,
          IFNULL(d.tpria_approved, 0) as approved
      FROM sys_users a
          JOIN sys_users_groups b ON (a.id = b.user_id)
          JOIN (
              SELECT 
                  x.sds_subscriber_id,
                  y.sd_name as sds_sd_name,
                  y.sd_subscriber_type as sds_subscriber_type
              FROM sys_dispositions_subscribers x
              JOIN sys_dispositions y ON (x.sds_sd_id = y.sd_id)
          ) c ON (
              c.sds_subscriber_id = 
                  (CASE c.sds_subscriber_type
                      WHEN 'group' THEN b.group_id
                      ELSE b.user_id
                  END)
          )
          LEFT JOIN (
              SELECT
                  k.tpr_id,
                  m.tpria_id,
                  m.tpria_su_id,
                  m.tpria_approved
              FROM
                  t_purchases_requisitions k 
                  JOIN t_purchases_requisitions_items l ON (k.tpr_id = l.tpri_tpr_id)
                  JOIN t_purchases_requisitions_items_app m ON (l.tpri_id = m.tpria_tpri_id)
              WHERE
                  k.tpr_no = v_tpr_no
          ) d ON (a.id = d.tpria_su_id)
      WHERE 
          c.sds_sd_name = 'PURCHASE-REQUISITION-APPROVAL'
      GROUP BY a.id, d.tpria_id

      ) t GROUP BY token;
  	RETURN v_status;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_rownum`() RETURNS tinyint(4)
BEGIN
    SET @rownum := IFNULL(@rownum, 0) + 1;
    RETURN @rownum;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_stock_beg_balance`(
        `v_tsj_mi_id` INTEGER(11),
        `v_tsj_ml_id` INTEGER(11),
        `v_date` DATETIME
    ) RETURNS double(15,2)
BEGIN
	DECLARE v_beg_bal DOUBLE(15, 2) DEFAULT 0.0;
    
    IF NOT ISNULL(v_tsj_ml_id) THEN
    	SELECT SUM(tsj_credit - tsj_debit) INTO v_beg_bal
        FROM t_stocks_journals
        WHERE
            tsj_mi_id = v_tsj_mi_id
            AND tsj_ml_id = v_tsj_ml_id
            AND tsj_date < v_date
        GROUP BY
            tsj_mi_id
        ORDER BY
            tsj_date, tsj_ref_code;
    ELSE
    	SELECT SUM(tsj_credit - tsj_debit) INTO v_beg_bal
        FROM t_stocks_journals
        WHERE
            tsj_mi_id = v_tsj_mi_id
            AND tsj_date < v_date
        GROUP BY
            tsj_mi_id
        ORDER BY
            tsj_date, tsj_ref_code;
    END IF;
    
    
    
    RETURN v_beg_bal;
    
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_stock_demand`(`v_mi_id` INTEGER(11)) RETURNS double(15,2)
BEGIN

	DECLARE v_qty_odm DOUBLE(15,2) DEFAULT 0.0;

    

    SELECT SUM(a.tti_qty_ost) INTO v_qty_odm


    FROM v_transfers_items_statuses a

    WHERE a.tti_mi_id = v_mi_id

    GROUP BY a.tti_mi_id;

    

    RETURN v_qty_odm;

END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_stock_mut_balance`(
        `v_tsj_mi_id` INTEGER(11),
        `v_tsj_ml_id` INTEGER(11),
        `v_date1` DATETIME,
        `v_date2` DATETIME
    ) RETURNS double(15,2)
BEGIN
	DECLARE v_end_bal DOUBLE(15, 2) DEFAULT 0.0;
    
    IF NOT ISNULL(v_tsj_ml_id) THEN
    	SELECT SUM(tsj_credit - tsj_debit) INTO v_end_bal
        FROM t_stocks_journals
        WHERE
            tsj_mi_id = v_tsj_mi_id
            AND tsj_ml_id = v_tsj_ml_id
            AND tsj_date BETWEEN v_date1 AND v_date2
        GROUP BY tsj_mi_id
        ORDER BY tsj_date, tsj_ref_code;
    ELSE
    	SELECT SUM(tsj_credit - tsj_debit) INTO v_end_bal
        FROM t_stocks_journals
        WHERE
            tsj_mi_id = v_tsj_mi_id
            AND tsj_date BETWEEN v_date1 AND v_date2
        GROUP BY tsj_mi_id
        ORDER BY tsj_date, tsj_ref_code;
    END IF;
    
    RETURN v_end_bal;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_stock_run_balance`(
        `v_tsj_mi_id` INTEGER(11),
        `v_tsj_ml_id` INTEGER(11),
        `v_tsj_date` DATETIME,
        `v_tsj_credit` DOUBLE(15,2),
        `v_tsj_debit` DOUBLE(15,2)
    ) RETURNS double(15,2)
BEGIN
	DECLARE v_run_token VARCHAR(20) DEFAULT NULL;
    DECLARE v_beg_bal DOUBLE(15,2) DEFAULT 0.0;
    
    SET v_run_token = f_get_stock_token(v_tsj_mi_id, v_tsj_ml_id);
    
    IF ISNULL(@v_run_token) OR @v_run_token != v_run_token THEN
    	SET v_beg_bal = f_get_stock_beg_balance(v_tsj_mi_id, v_tsj_ml_id, v_tsj_date);
    	SET @run_bal := (v_beg_bal + v_tsj_credit - v_tsj_debit);
    ELSE
    	SET v_beg_bal = 0;
    	SET @run_bal := IFNULL(@run_bal, 0) + (v_beg_bal + v_tsj_credit - v_tsj_debit);
    END IF;
    
    SET @v_run_token := v_run_token;
    RETURN @run_bal;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_stock_token`(
        `v_tsj_mi_id` INTEGER(11),
        `v_tsj_ml_id` INTEGER(11)
    ) RETURNS varchar(20) CHARSET utf8
BEGIN
	RETURN CONCAT_WS('-', CAST(v_tsj_mi_id AS CHAR), CAST(v_tsj_ml_id AS CHAR));
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `f_get_user_fullname`(
        `p_id` INTEGER(11)
    ) RETURNS varchar(100) CHARSET utf8
BEGIN
	DECLARE v_fullname VARCHAR(100) DEFAULT NULL;
    SELECT 
    	CONCAT_WS(
        	' ',
            IF((first_name = '' OR first_name IS NULL), username, first_name),
            IF((last_name = '' OR last_name IS NULL), '', last_name)
        ) INTO v_fullname
    FROM
    	sys_users
    WHERE
    	id = p_id;
  RETURN v_fullname;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `m_employee`
--

CREATE TABLE IF NOT EXISTS `m_employee` (
  `me_id` int(11) NOT NULL,
  `me_md_id` int(11) DEFAULT NULL,
  `me_mep_id` varchar(50) DEFAULT NULL,
  `me_nik` varchar(255) DEFAULT NULL,
  `me_rfid` varchar(25) NOT NULL,
  `me_barcode` varchar(25) NOT NULL,
  `me_first_name` varchar(25) DEFAULT NULL,
  `me_middle_name` varchar(25) DEFAULT NULL,
  `me_last_name` varchar(25) DEFAULT NULL,
  `me_dob` date DEFAULT NULL,
  `me_gender` varchar(15) DEFAULT NULL,
  `me_hp` varchar(25) DEFAULT NULL,
  `me_email` varchar(100) DEFAULT NULL,
  `me_address` text,
  `me_working_since` date DEFAULT NULL,
  `me_status_kontrak` int(11) NOT NULL,
  `me_status_keaktifan` varchar(25) NOT NULL,
  `me_kendaraan` varchar(25) NOT NULL,
  `me_foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_employee`
--

INSERT INTO `m_employee` (`me_id`, `me_md_id`, `me_mep_id`, `me_nik`, `me_rfid`, `me_barcode`, `me_first_name`, `me_middle_name`, `me_last_name`, `me_dob`, `me_gender`, `me_hp`, `me_email`, `me_address`, `me_working_since`, `me_status_kontrak`, `me_status_keaktifan`, `me_kendaraan`, `me_foto`) VALUES
(1, 10, '1', '123', '', '', 'Mas', '', 'Ganteng', '2015-05-20', '0', '08567167648', 'ones006@gmail.com', 'adasdasd', '2015-05-20', 0, '', '', ''),
(2, 25, '2', '1267166261', '', '', 'Roso', '', 'Sasongko', '2015-06-07', '1', '081298419718', 'roso.sasongko@gmail.com', 'Jl. DI. Panjaitan No. 128 Purwokerto', '2015-06-07', 0, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `m_employee_positions`
--

CREATE TABLE IF NOT EXISTS `m_employee_positions` (
  `mep_id` int(11) NOT NULL,
  `mep_name` varchar(255) DEFAULT NULL,
  `mep_desc` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `m_employee_positions`
--

INSERT INTO `m_employee_positions` (`mep_id`, `mep_name`, `mep_desc`) VALUES
(1, 'Manager', 'Manager'),
(2, 'Supervisor', 'Supervisor');

-- --------------------------------------------------------

--
-- Table structure for table `m_obat`
--

CREATE TABLE IF NOT EXISTS `m_obat` (
  `mob_id` int(11) NOT NULL,
  `mob_nama_obat` text NOT NULL,
  `mob_tanggal_beli` date NOT NULL,
  `mob_jumlah` int(11) NOT NULL,
  `mob_satuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `m_potongan`
--

CREATE TABLE IF NOT EXISTS `m_potongan` (
  `mpo_id` int(11) NOT NULL,
  `mpo_me_id` int(11) NOT NULL,
  `mpo_jumlah` int(11) NOT NULL,
  `mpo_keterangan` text NOT NULL,
  `mpo_tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tob_transaksi_obat`
--

CREATE TABLE IF NOT EXISTS `tob_transaksi_obat` (
  `tob_id` int(11) NOT NULL,
  `tob_tpa_id` int(11) NOT NULL,
  `tob_mob_nama_obat` text NOT NULL,
  `tob_mob_jumlah` int(11) NOT NULL,
  `tob_satuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tpa_pasien`
--

CREATE TABLE IF NOT EXISTS `tpa_pasien` (
  `tpa_id` int(11) NOT NULL,
  `tpa_tanggal_berobat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `tpa_me_id` int(11) NOT NULL,
  `tpa_nama` text NOT NULL,
  `tpa_ttl` date NOT NULL,
  `tpa_mep_name` text NOT NULL,
  `tpa_keterangan` text NOT NULL,
  `tpa_jumlahberobat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `m_employee`
--
ALTER TABLE `m_employee`
  ADD PRIMARY KEY (`me_id`);

--
-- Indexes for table `m_employee_positions`
--
ALTER TABLE `m_employee_positions`
  ADD PRIMARY KEY (`mep_id`);

--
-- Indexes for table `m_obat`
--
ALTER TABLE `m_obat`
  ADD PRIMARY KEY (`mob_id`);

--
-- Indexes for table `m_potongan`
--
ALTER TABLE `m_potongan`
  ADD PRIMARY KEY (`mpo_id`);

--
-- Indexes for table `tob_transaksi_obat`
--
ALTER TABLE `tob_transaksi_obat`
  ADD PRIMARY KEY (`tob_id`);

--
-- Indexes for table `tpa_pasien`
--
ALTER TABLE `tpa_pasien`
  ADD PRIMARY KEY (`tpa_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `m_obat`
--
ALTER TABLE `m_obat`
  MODIFY `mob_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_potongan`
--
ALTER TABLE `m_potongan`
  MODIFY `mpo_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tob_transaksi_obat`
--
ALTER TABLE `tob_transaksi_obat`
  MODIFY `tob_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tpa_pasien`
--
ALTER TABLE `tpa_pasien`
  MODIFY `tpa_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
