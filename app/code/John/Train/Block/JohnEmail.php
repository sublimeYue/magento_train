<?php
namespace John\Train\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\View\Element\Template;

class JohnEmail extends Template
{

    /**
     * Construct
     *
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    )
    {
        parent::__construct($context, $data);
    }

    /**
     * Get form action URL for POST booking request
     *
     * @return string
     */
    public function getFormAction()
    {
        return '/test/page/view';
    }

}