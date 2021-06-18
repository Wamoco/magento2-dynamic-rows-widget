<?php

namespace Wamoco\DynamicRowsWidget\Block\Adminhtml\Widget;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

/**
 * Class DynamicRows
 * @package Wamoco\DynamicRowsWidget\Block\Adminhtml\Widget
 */
class DynamicRows extends AbstractFieldArray
{
    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('title', [
            'label' => __('Title')
        ]);
        $this->addColumn('url', [
            'label' => __('Url')
        ]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add');
    }
}
