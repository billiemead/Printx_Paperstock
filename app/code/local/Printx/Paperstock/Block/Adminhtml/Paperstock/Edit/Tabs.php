<?php
class Printx_Paperstock_Block_Adminhtml_Paperstock_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("paperstock_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("paperstock")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("paperstock")->__("Item Information"),
				"title" => Mage::helper("paperstock")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("paperstock/adminhtml_paperstock_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
