<?php
	
class Printx_Paperstock_Block_Adminhtml_Paperstock_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "paperstock_id";
				$this->_blockGroup = "paperstock";
				$this->_controller = "adminhtml_paperstock";
				$this->_updateButton("save", "label", Mage::helper("paperstock")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("paperstock")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("paperstock")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("paperstock_data") && Mage::registry("paperstock_data")->getId() ){

				    return Mage::helper("paperstock")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("paperstock_data")->getId()));

				} 
				else{

				     return Mage::helper("paperstock")->__("Add Item");

				}
		}
}