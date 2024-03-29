<?php

namespace Training\Feedback\Controller\Index;

class Form extends \Magento\Framework\App\Action\Action
{
    private $pageResultFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $pageResultFactory
    ) {
        $this->pageResultFactory = $pageResultFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->pageResultFactory->create();
    }
}
