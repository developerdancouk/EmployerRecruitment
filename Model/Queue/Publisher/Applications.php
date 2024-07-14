<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Model\Queue\Publisher;

use Employer\Recruitment\Helper\Settings;
use Employer\Recruitment\Model\Queue\Publisher;
use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\MessageQueue\PublisherInterface;
use Magento\Framework\Serialize\Serializer\Json;

class Applications extends Publisher
{
    public const IMPORT_TOPIC = 'recruitment.queue.applications.process';
    public const IMPORT_TYPE = 'applicant';

    /**
     * @var PublisherInterface
     */
    protected PublisherInterface $publisher;
    /**
     * @var Settings
     */
    protected Settings $settings;
    /**
     * @var Json
     */
    protected Json $json;
    /**
     * @var ProductRepositoryInterface
     */
    protected ProductRepositoryInterface $productRepository;
    /**
     * @var SearchCriteriaBuilder
     */
    protected SearchCriteriaBuilder $searchCriteriaBuilder;

    /**
     * @param PublisherInterface $publisher
     * @param Settings $settings
     * @param Json $json
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteriaBuilder
     */
    public function __construct(
        PublisherInterface         $publisher,
        Settings                   $settings,
        Json                       $json,
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder      $searchCriteriaBuilder
    )
    {
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->productRepository = $productRepository;
        $this->json = $json;
        $this->settings = $settings;
        $this->publisher = $publisher;
        parent::__construct(
            $publisher,
            $json,
            $settings,
            $searchCriteriaBuilder
        );
    }

    /**
     * @param $data
     * @return void
     */

    public function import($data): void
    {
        if (!is_array($data)) {
            $newDataArray['id'] = $data;
            $data = $newDataArray;
        }
        $this->publishData($data, self::IMPORT_TYPE, self::IMPORT_TOPIC);
    }

}
