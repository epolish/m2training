<?php

namespace Training\Test\Plugin\Block;

class Template
{
    public function afterToHtml(
        \Magento\Framework\View\Element\Template $subject,
        $result
    ) {
        if ($subject->getNameInLayout() !== 'top.search') {
            return $result;
        }

        $class = get_class($subject);
        $result = <<<HTML
        <div>
            <p>{$subject->getTemplate()}</p>
            <p>$class</p>
            $result
        </div>
HTML;

        return $result;
    }
}
