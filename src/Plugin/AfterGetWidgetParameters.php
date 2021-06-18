<?php

namespace Wamoco\DynamicRowsWidget\Plugin;

/**
 * Class AfterGetWidgetParameters
 * @package Wamoco\DynamicRowsWidget\Plugin
 */
class AfterGetWidgetParameters
{
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serializer;

    /**
     * AfterGetWidgetParameters constructor.
     * @param \Magento\Framework\Serialize\Serializer\Json $serializer
     */
    public function __construct(
        \Magento\Framework\Serialize\Serializer\Json $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * @param \Magento\Widget\Model\Widget\Instance $subject
     * @param $result
     * @return mixed
     */
    public function afterGetWidgetParameters(\Magento\Widget\Model\Widget\Instance $subject, $result)
    {
        foreach ($result as $key => $value){
            if(is_array($value)){
                foreach ($value as $innerKey => $innerValue) {
                    if(is_array($innerValue)){
                        $value[$innerKey] = $this->serializer->serialize($innerValue);
                    }
                }
                $result[$key] = $value;
            }
        }
        return $result;
    }
}