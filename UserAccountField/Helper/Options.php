<?php
namespace Dev\UserAccountField\Helper;

use Magento\Eav\Model\Entity\Attribute\Source\AbstractSource;
use Magento\Eav\Model\Entity\Attribute\Source\SourceInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Store\Model\ScopeInterface;

class Options extends AbstractSource implements SourceInterface, OptionSourceInterface
{
    const XML_CONFIG_PATH = 'user_account_section/select_value/select_field';
    protected $scopeConfig;
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }
    public function getConfig()
    {
        $configValue = $this->scopeConfig->getValue(self::XML_CONFIG_PATH,ScopeInterface::SCOPE_STORE);
        $configArray = explode(",",$configValue);
        return $configArray;
    }
    public function getAllOptions()
    {
        $result = [['value' => '', 'label' => 'Please Select Value'],];

        foreach (self::getConfig() as $index => $value) {
            $result[] = ['value' => $index, 'label' => $value];
        }
        return $result;
    }
}