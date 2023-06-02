<?php

namespace Dev\UserAccountField\Helper\Frontend;

use Magento\Framework\Option\ArrayInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Options extends AbstractHelper    
{
    const XML_CONFIG_PATH = 'user_account_section/select_value/select_field';
    const SHOW_FRONTEND = 'user_account_section/select_value/show_frontend';
    public $_storeManager;

    public function getConfig()
    {
        $configValue = $this->scopeConfig->getValue(self::XML_CONFIG_PATH,ScopeInterface::SCOPE_STORE); // For Store
        $configArray = explode(",",$configValue);
        return $configArray;
    }
    public function isShowFrontend()
    {
        $configValue = $this->scopeConfig->getValue(self::SHOW_FRONTEND,ScopeInterface::SCOPE_STORE); // For Store
        return $configValue;
    }
}