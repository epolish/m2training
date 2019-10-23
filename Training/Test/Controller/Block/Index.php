<?php

namespace Training\Test\Controller\Block;

class Index extends \Magento\Framework\App\Action\Action
{
    private $layoutFactory;

    private $resultRawFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\Controller\Result\RawFactory $resultRawFactory
    ) {
        $this->layoutFactory = $layoutFactory;
        $this->resultRawFactory = $resultRawFactory;

        parent::__construct($context);
    }

    public function execute()
    {
        $layout = $this->layoutFactory->create();
        $resultRaw = $this->resultRawFactory->create();
        $block = $layout->createBlock(\Training\Test\Block\Test::class);

        return $resultRaw->setContents($block->toHtml());
    }
}
