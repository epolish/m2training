<?php

namespace Training\Test\Plugin\Block\Product\View;

class Description
{
    public function beforeToHtml(
        \Magento\Catalog\Block\Product\View\Description $subject
    ) {
        if ($subject->getNameInLayout() !== 'product.info.sku') {
            return;
        }

        $subject->setTemplate('Training_Test::description.phtml');
    }
}
