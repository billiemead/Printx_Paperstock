<?php

class Printx_Paperstock_Adminhtml_PaperstockController extends Mage_Adminhtml_Controller_Action
{
		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("paperstock/paperstock")->_addBreadcrumb(Mage::helper("adminhtml")->__("Paperstock  Manager"),Mage::helper("adminhtml")->__("Paperstock Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Paperstock"));
			    $this->_title($this->__("Manager Paperstock"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Paperstock"));
				$this->_title($this->__("Paperstock"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("paperstock/paperstock")->load($id);
				if ($model->getId()) {
					Mage::register("paperstock_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("paperstock/paperstock");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Paperstock Manager"), Mage::helper("adminhtml")->__("Paperstock Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Paperstock Description"), Mage::helper("adminhtml")->__("Paperstock Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("paperstock/adminhtml_paperstock_edit"))->_addLeft($this->getLayout()->createBlock("paperstock/adminhtml_paperstock_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("paperstock")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Paperstock"));
		$this->_title($this->__("Paperstock"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("paperstock/paperstock")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("paperstock_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("paperstock/paperstock");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Paperstock Manager"), Mage::helper("adminhtml")->__("Paperstock Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Paperstock Description"), Mage::helper("adminhtml")->__("Paperstock Description"));


		$this->_addContent($this->getLayout()->createBlock("paperstock/adminhtml_paperstock_edit"))->_addLeft($this->getLayout()->createBlock("paperstock/adminhtml_paperstock_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						
					$post_data['stocktype']=implode(',',$post_data['stocktype']);

						$model = Mage::getModel("paperstock/paperstock")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Paperstock was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setPaperstockData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setPaperstockData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("paperstock/paperstock");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('paperstock_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("paperstock/paperstock");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'paperstock.csv';
			$grid       = $this->getLayout()->createBlock('paperstock/adminhtml_paperstock_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'paperstock.xml';
			$grid       = $this->getLayout()->createBlock('paperstock/adminhtml_paperstock_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
