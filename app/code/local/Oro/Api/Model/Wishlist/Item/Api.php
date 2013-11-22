<?php
/** {license_text}  */
class Oro_Api_Model_Wishlist_Item_Api
    extends Mage_Checkout_Model_Api_Resource
{
    /**
     * @param array|object $filters
     * @return array
     */
    public function items($filters)
    {
        /** @var Mage_Wishlist_Model_Resource_Item_Collection $collection */
        $collection = Mage::getResourceModel('wishlist/item_collection');
        /** @var $apiHelper Mage_Api_Helper_Data */
        $apiHelper = Mage::helper('api');
        $filters = $apiHelper->parseFilters($filters);
        try {
            foreach ($filters as $field => $value) {
                $collection->addFieldToFilter($field, $value);
            }
        } catch (Mage_Core_Exception $e) {
            $this->_fault('filters_invalid', $e->getMessage());
        }

        $arr = $collection->toArray();

        return $arr['items'];
    }
}
