<?php

namespace Training\Feedback\Controller\Index;

use Training\Feedback\Api\Data\FeedbackInterface;

class Test extends \Magento\Framework\App\Action\Action
{
    private $feedbackFactory;

    private $feedbackRepository;

    private $searchCriteriaBuilder;

    private $sortOrderBuilder;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Training\Feedback\Api\Data\FeedbackInterfaceFactory $feedbackFactory,
        \Training\Feedback\Api\FeedbackRepositoryInterface $feedbackRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder
    ) {
        $this->feedbackFactory = $feedbackFactory;
        $this->feedbackRepository = $feedbackRepository;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->sortOrderBuilder = $sortOrderBuilder;

        parent::__construct($context);
    }

    public function execute()
    {
        // create new item
//        $newFeedback = $this->feedbackFactory->create();
//        $newFeedback->setAuthorName('some name');
//        $newFeedback->setAuthorEmail('test@test.com');
//        $newFeedback->setMessage('ghj dsghjfghs sghkfgsdhfkj sdhjfsdf gsfkj');
//        $newFeedback->setIsActive(1);
//        $this->feedbackRepository->save($newFeedback);
        // load item by id
//        $feedback = $this->feedbackRepository->getById(13);
//        $this->printFeedback($feedback);
        // update item
//        $feedbackToUpdate = $this->feedbackRepository->getById(13);
//        $feedbackToUpdate->setMessage('CUSTOM ' . $feedbackToUpdate->getMessage());
//        $this->feedbackRepository->save($feedbackToUpdate);
        // delete feedback
//        $this->feedbackRepository->deleteById(13);
        // load multiple items
        $this->searchCriteriaBuilder
            ->addFilter(FeedbackInterface::IS_ACTIVE, 1);

        $sortOrder = $this->sortOrderBuilder
            ->setField(FeedbackInterface::AUTHOR_EMAIL)
            ->setAscendingDirection()
            ->create();

        $this->searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $this->searchCriteriaBuilder->create();
        $searchResult = $this->feedbackRepository->getList($searchCriteria);

        foreach ($searchResult->getItems() as $item) {
            $this->printFeedback($item);
        }

        exit();
    }

    private function printFeedback($feedback)
    {
        echo $feedback->getId() . ' : '
            . $feedback->getAuthorName()
            . ' (' . $feedback->getAuthorEmail() . ')';
        echo "<br/>\n";
    }
}
