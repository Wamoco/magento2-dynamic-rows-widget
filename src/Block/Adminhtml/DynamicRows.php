<?php

namespace Wamoco\DynamicRowsWidget\Block\Adminhtml;

/**
 * Class DynamicRows
 * @package Wamoco\DynamicRowsWidget\Block\Adminhtml
 */
class DynamicRows extends \Magento\Backend\Block\Widget
{
    /**
     * Block-Class to be generated through layout
     * @var string
     */
    protected $_blockClassName = \Wamoco\DynamicRowsWidget\Block\Adminhtml\Widget\DynamicRows::class;

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $jsonSerializer;

    /**
     * DynamicRows constructor.
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Serialize\Serializer\Json $jsonSerializer
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $jsonSerializer,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->jsonSerializer = $jsonSerializer;
    }
    /**
     * Prepare chooser element HTML
     *
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element Form Element
     * @return \Magento\Framework\Data\Form\Element\AbstractElement
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function prepareElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $uniqId = $this->mathRandom->getUniqueHash($element->getId());

        $dynamicRows = $this->getLayout()->createBlock(
            $this->_blockClassName
        )->setElement(
            $element
        )->setConfig(
            $this->getConfig()
        )->setFieldsetId(
            $this->getFieldsetId()
        )->setUniqId(
            $uniqId
        );

        if ($element->getValue()) {
            $values = $element->getValue();
            $values = array_filter($values);
            $serializer = $this->jsonSerializer;
            $values = array_map(function($entry) use ($serializer){
                return $serializer->unserialize($entry);
            }, $values);
            $element->setValue($values);
        }

        $element->setData('after_element_html', $dynamicRows->toHtml());
        return $element;
    }
}
