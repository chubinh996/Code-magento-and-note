<?php
/**
* Copyright 2016 aheadWorks. All rights reserved.
* See LICENSE.txt for license details.
*/

namespace Aheadworks\Pquestion\Ui\Component\Listing\Columns\Product;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Product extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var \Magento\Framework\Filter\FilterManager
     */
    protected $_filterManager;

    /**
     * @param \Magento\Framework\Filter\FilterManager $filterManager
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Filter\FilterManager $filterManager,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_filterManager = $filterManager;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        foreach ($dataSource['data']['items'] as & $item) {
            $name = $this->_filterManager->truncate(
                $item['name'],
                ['length' => 80, 'etc' => '...', 'remainder' => '', 'breakWords' => true]
            );
            $url = $this->context->getUrl('productquestion/question/filter', ['id' => $item['entity_id']]);
            $link = "<a href='" . $url . "' onclick='setLocation(this.href)'>" . $name . "</a>";
            $item['name'] = $link;
        }

        return $dataSource;
    }
}
