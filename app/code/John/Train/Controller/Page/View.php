<?php
namespace John\Train\Controller\Page;

use Magento\Framework\Controller\ResultFactory;
use Magento\User\Model\User;
use Magento\User\Model\UserFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\User\Model\ResourceModel\User as UserResouce;

class View extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var User
     */
    private $userResource;


    /**
     * @var UserFactory
     */
    private $adminUser;

    /**
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param UserFactory $adminUser
     * @param UserResouce $userResource
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        UserFactory $adminUser,
        UserResouce $userResource
    )
    {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->adminUser = $adminUser;
        $this->userResource = $userResource;
        parent::__construct($context);
    }

    public function execute()
    {
        $email = $this->getRequest()->getPost('email', '');
        if (!empty($email)) {
            $adminUser = $this->adminUser->create();
            $this->userResource->load($adminUser, $email, 'email');
            $adminUser instanceof User && !empty($adminUser->getId())?
                $this->messageManager->addSuccessMessage($adminUser->getFirstName().' '.$adminUser->getLastName()) :
                $this->messageManager->addErrorMessage('Has no user! The email is: '.$email);
            $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
            $resultRedirect->setUrl('/test/page/view');
            return $resultRedirect;
        }
        $this->_view->loadLayout();
        $this->_view->renderLayout();
    }
}