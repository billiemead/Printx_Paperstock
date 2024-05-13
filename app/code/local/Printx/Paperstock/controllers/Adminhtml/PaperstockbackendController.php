<?php
class Printx_Paperstock_Adminhtml_PaperstockbackendController extends Mage_Adminhtml_Controller_Action
{
	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Manage Paperstock"));
	   $this->renderLayout();
    }
}