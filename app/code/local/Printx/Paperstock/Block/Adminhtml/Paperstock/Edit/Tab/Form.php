<?php
class Printx_Paperstock_Block_Adminhtml_Paperstock_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
		protected function _prepareForm()
		{

				$form = new Varien_Data_Form();
				$this->setForm($form);
				$fieldset = $form->addFieldset("paperstock_form", array("legend"=>Mage::helper("paperstock")->__("Item information")));

				
						$fieldset->addField("stockname", "text", array(
						"label" => Mage::helper("paperstock")->__("Name"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "stockname",
						));
									
						 $fieldset->addField('stocktype', 'multiselect', array(
						'label'     => Mage::helper('paperstock')->__('Type'),
						'values'   => Printx_Paperstock_Block_Adminhtml_Paperstock_Grid::getValueArray1(),
						'name' => 'stocktype',					
						"class" => "required-entry",
						"required" => true,
						));
						$fieldset->addField("stockprice", "text", array(
						"label" => Mage::helper("paperstock")->__("Price"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "stockprice",
						));
					
						$fieldset->addField("stockcost", "text", array(
						"label" => Mage::helper("paperstock")->__("Cost"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "stockcost",
						));
					
						$fieldset->addField("stockweight", "text", array(
						"label" => Mage::helper("paperstock")->__("Weight"),					
						"class" => "required-entry",
						"required" => true,
						"name" => "stockweight",
						));
					

				if (Mage::getSingleton("adminhtml/session")->getPaperstockData())
				{
					$form->setValues(Mage::getSingleton("adminhtml/session")->getPaperstockData());
					Mage::getSingleton("adminhtml/session")->setPaperstockData(null);
				} 
				elseif(Mage::registry("paperstock_data")) {
				    $form->setValues(Mage::registry("paperstock_data")->getData());
				}
				return parent::_prepareForm();
		}
}
