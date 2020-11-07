<?php
namespace ChuWu\CustomerState\Plugin;

class StateFilter
{
    protected  $scopeConfig;
    protected  $allowedUsStates;

    /**
     * StateFilter constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function  __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    )
    {
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @param $subject
     * @param $options
     * @return array
     */
    public function afterToOptionArray($subject,$options)
    {
        $allowedStates = $this->scopeConfig->getValue('checkout/state_filter/us_state_filter',\Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        $this->allowedUsStates = explode(',',$allowedStates);
        $result = array_filter($options, function ($option){
            if(isset($option['label'])){
                    return in_array($option['label'],$this->allowedUsStates);
            }
            return true;
        });
        return $result;
    }
}

