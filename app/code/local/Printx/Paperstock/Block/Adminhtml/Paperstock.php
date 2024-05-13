<?php


class Printx_Paperstock_Block_Adminhtml_Paperstock extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_paperstock";
	$this->_blockGroup = "paperstock";
	$this->_headerText = Mage::helper("paperstock")->__("Paperstock Manager");
	$this->_addButtonLabel = Mage::helper("paperstock")->__("Add New Item");
	parent::__construct();
	
	}

}