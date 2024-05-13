<?php
$installer = $this;
$installer->startSetup();
$sql=<<<SQLTEXT
create table paperstock (paperstock_id int not null auto_increment, stockname varchar(100),primary key(paperstock_id));

		
SQLTEXT;

$installer->run($sql);

$installer->endSetup();
	 