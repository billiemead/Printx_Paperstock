<?php
class Printx_Paperstock_Model_Mysql4_Paperstock extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("paperstock/paperstock", "paperstock_id");
    }
}