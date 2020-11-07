<?php
namespace ChuWu\CustomerState\Model\Config\Region;

class RegionInformationProvider
{
    /**
     * @var \Magento\Director\Api\CountryInformationAcquirerInterface
     */
    protected $countryInformationAcquirer;
    protected $addressRepository;

    /**
     * RegionInformationProvider constructor.
     * @param \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformationAcquirer
     */
    public function __construct(
        \Magento\Directory\Api\CountryInformationAcquirerInterface $countryInformationAcquirer
    )
    {
        $this->countryInformationAcquirer = $countryInformationAcquirer;
    }

    /**
     * @return array
     */
    public function toOptionArray()
    {
        $countries = $this->countryInformationAcquirer->getCountriesInfo();
        foreach ($countries as $country) {
            //get regions for this country
            $regions = [];
            if ($availableRegions = $country->getAvailableRegions()) {
                foreach ($availableRegions as $region) {
                    $regions[] = [
                        'value' => $region->getName(),
                        'label' => $region->getName()
                    ];
                }
            }
            return $regions;
        }
    }
}

