<?php

namespace Training\Feedback\Controller\Adminhtml\Index;

use Magento\Framework\Exception\NoSuchEntityException;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Training_Feedback::feedback_save';

    private $resultPageFactory;

    private $feedbackRepository;

    private $feedbackFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Training\Feedback\Model\FeedbackFactory $feedbackFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->feedbackFactory = $feedbackFactory;

        parent::__construct($context);
    }
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $model = $this->feedbackFactory->create();
        $id = $this->getRequest()->getParam('feedback_id');

        if ($id) {
            try {
                $model = $this->feedbackRepository->getById($id);
            } catch (NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This feedback no longer exists.'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();

        $resultPage
            ->setActiveMenu('Training_Feedback::feedback')
            ->addBreadcrumb(__('Feedbacks'), __('Feedbacks'))
            ->addBreadcrumb(
                $id ? __('Edit Feedback') : __('New Feedback'),
                $id ? __('Edit Feedback') : __('New Feedback')
            );

        return $resultPage;
    }
}
