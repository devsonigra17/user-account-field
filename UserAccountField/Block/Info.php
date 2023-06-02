<?php

namespace Dev\UserAccountField\Block;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Helper\View;
use Magento\Customer\Block\Form\Register;
use Magento\Customer\Helper\Session\CurrentCustomer;

class Info extends \Magento\Framework\View\Element\Template
{
    protected $customerSession;  
    protected $customerRepository;
    protected $_helperView;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Customer\Model\Session $customerSession,
        CustomerRepositoryInterface $customerRepository,
        CurrentCustomer $currentCustomer,
        View $helperView

    ) {
        $this->customerSession = $customerSession;
        $this->customerRepository = $customerRepository;
        $this->_helperView = $helperView;
        $this->currentCustomer = $currentCustomer;
        parent::__construct($context);
    }
    public function getCustomerId()
    {
        return $this->customerSession->getCustomer()->getId();
    }
    public function getAttributeValue($customerId)
    {
        $customer = $this->customerRepository->getById($customerId);
        if($customer->getCustomAttribute('select_field')!=NULL)
        {
            return $customer->getCustomAttribute('select_field')->getValue();
        }
        else {
            return NULL;
        }
    }
    
    public function getCustomer()
    {
        try {
            return $this->currentCustomer->getCustomer();
        } catch (NoSuchEntityException $e) {
            return null;
        }
    }

    public function getName()
    {
        return $this->_helperView->getCustomerName($this->getCustomer());
    }

    public function getChangePasswordUrl()
    {
        return $this->_urlBuilder->getUrl('customer/account/edit/changepass/1');
    }

    public function isNewsletterEnabled()
    {
        return $this->getLayout()
            ->getBlockSingleton(Register::class)
            ->isNewsletterEnabled();
    }
}