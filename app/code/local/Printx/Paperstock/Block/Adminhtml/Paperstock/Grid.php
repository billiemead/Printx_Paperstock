<?php

class Printx_Paperstock_Block_Adminhtml_Paperstock_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("paperstockGrid");
				$this->setDefaultSort("paperstock_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("paperstock/paperstock")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("paperstock_id", array(
				"header" => Mage::helper("paperstock")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "paperstock_id",
				));
                
				$this->addColumn("stockname", array(
				"header" => Mage::helper("paperstock")->__("Name"),
				"index" => "stockname",
				));
				$this->addColumn("stockprice", array(
				"header" => Mage::helper("paperstock")->__("Price"),
				"index" => "stockprice",
				));
				$this->addColumn("stockcost", array(
				"header" => Mage::helper("paperstock")->__("Cost"),
				"index" => "stockcost",
				));
				$this->addColumn("stockweight", array(
				"header" => Mage::helper("paperstock")->__("Weight"),
				"index" => "stockweight",
				));
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('paperstock_id');
			$this->getMassactionBlock()->setFormFieldName('paperstock_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_paperstock', array(
					 'label'=> Mage::helper('paperstock')->__('Remove Paperstock'),
					 'url'  => $this->getUrl('*/adminhtml_paperstock/massRemove'),
					 'confirm' => Mage::helper('paperstock')->__('Are you sure?')
				));
			return $this;
		}
			
		static public function getOptionArray1()
		{
            $data_array=array(); 
			$data_array[0]='Cover';
			$data_array[1]='Text';
			$data_array[2]='Envelope';
			$data_array[3]='Bond';
			$data_array[4]='Other';
            return($data_array);
		}
		static public function getValueArray1()
		{
            $data_array=array();
			foreach(Printx_Paperstock_Block_Adminhtml_Paperstock_Grid::getOptionArray1() as $k=>$v){
               $data_array[]=array('value'=>$k,'label'=>$v);		
			}
            return($data_array);

		}
		

}