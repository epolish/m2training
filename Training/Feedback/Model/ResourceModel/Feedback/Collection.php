<?php

namespace Training\Feedback\Model\ResourceModel\Feedback;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \Training\Feedback\Model\Feedback::class,
            \Training\Feedback\Model\ResourceModel\Feedback::class
        );
    }

    public function getAllFeedbackNumber()
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from('training_feedback', new \Zend_Db_Expr('COUNT(*)'));

        return $adapter->fetchOne($select);
    }

    public function getActiveFeedbackNumber()
    {
        $adapter = $this->getConnection();
        $select = $adapter->select()
            ->from('training_feedback', new \Zend_Db_Expr('COUNT(*)'))
            ->where('is_active = ?', \Training\Feedback\Model\Feedback::STATUS_ACTIVE);

        return $adapter->fetchOne($select);
    }
}
