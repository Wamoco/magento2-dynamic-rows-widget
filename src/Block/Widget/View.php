<?php

namespace Wamoco\DynamicRowsWidget\Block\Widget;

use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

/**
 * Class View
 * @package Wamoco\DynamicRowsWidget\Block\Widget
 */
class View extends Template implements BlockInterface
{
    /**
     * @var string
     */
    protected $_template = "Wamoco_DynamicRowsWidget::widget/view.phtml";

    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serializer;

    /**
     * View constructor.
     * @param Template\Context $context
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     * @param LogoFactory $logoFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        \Magento\Framework\Serialize\Serializer\Json $serializer,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->serializer = $serializer;
    }

    /**
     * @param $type
     * @return DataObject[]
     */
    public function getLinkObjects($type)
    {
        $links = $this->getData($type);

        // not sure what happens to backend serialized array...
        $links = '['.rtrim($links, ',').']';
        $links =  $this->serializer->unserialize($links);

        return array_map(function($element){
            return new DataObject($element);
        }, $links);
    }
}