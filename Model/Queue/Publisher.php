<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Model\Queue;

use Employer\Recruitment\Helper\Settings;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json;

class Publisher
{

    /**
     * @param PublisherInterface $publisher
     * @param Json $json
     * @param Settings $settings
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        protected PublisherInterface    $publisher,
        protected Json                  $json,
        protected Settings              $settings,
        protected SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
    }

    /**
     * @param $data
     * @param $type
     * @param $topic
     * @return void
     */
    public function publishData($data, $type, $topic): void
    {
        $rawData = [$type => $data];
        $this->publisher->publish($topic, $this->json->serialize($rawData));
    }

}
