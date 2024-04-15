<?php

namespace Impact\Campaign\Ui\Component\Form\Field;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $arr     = $this->toArray();
        $options = [];
        foreach ($arr as $key => $value) {
            $options[] = [
                'value' => $key,
                'label' => $value
            ];
        }

        return $options;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $status = [
            '1' => 'Enabled',
            '0' => 'Disabled',

        ];

        return $status;
    }
}
