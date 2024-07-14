<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */
declare(strict_types=1);

namespace Employer\Recruitment\Model;

use Employer\Recruitment\Api\ApplicantsRepositoryInterface;
use Employer\Recruitment\Api\Data\ApplicantsInterface;
use Employer\Recruitment\Api\Data\ApplicantsInterfaceFactory;
use Employer\Recruitment\Api\Data\ApplicantsSearchResultsInterface;
use Employer\Recruitment\Api\Data\ApplicantsSearchResultsInterfaceFactory;
use Employer\Recruitment\Model\ResourceModel\Applicants as ResourceApplicants;
use Employer\Recruitment\Model\ResourceModel\Applicants\CollectionFactory as ApplicantsCollectionFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;

class ApplicantsRepository implements ApplicantsRepositoryInterface
{

    /**
     * @param ResourceApplicants $resource
     * @param ApplicantsInterfaceFactory $applicantsFactory
     * @param ApplicantsCollectionFactory $applicantsCollectionFactory
     * @param ApplicantsSearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        protected ResourceApplicants                      $resource,
        protected ApplicantsInterfaceFactory              $applicantsFactory,
        protected ApplicantsCollectionFactory             $applicantsCollectionFactory,
        protected ApplicantsSearchResultsInterfaceFactory $searchResultsFactory,
        protected CollectionProcessorInterface            $collectionProcessor
    )
    {
    }

    /**
     * @param ApplicantsInterface $applicants
     * @return ApplicantsInterface
     * @throws CouldNotSaveException
     */
    public function save(ApplicantsInterface $applicants): ApplicantsInterface
    {
        try {
            $this->resource->save($applicants);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the applicants: %1',
                $exception->getMessage()
            ));
        }
        return $applicants;
    }

    /**
     * @param SearchCriteriaInterface $criteria
     * @return ApplicantsSearchResultsInterface
     */
    public function getList(
        SearchCriteriaInterface $criteria
    ): ApplicantsSearchResultsInterface
    {
        $collection = $this->applicantsCollectionFactory->create();
        $this->collectionProcessor->process($criteria, $collection);
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @param string $applicantsId
     * @return bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById(string $applicantsId): bool
    {
        return $this->delete($this->get($applicantsId));
    }

    /**
     * @param ApplicantsInterface $applicants
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(ApplicantsInterface $applicants): bool
    {
        try {
            $applicantsModel = $this->applicantsFactory->create();
            $this->resource->load($applicantsModel, $applicants->getApplicantsId());
            $this->resource->delete($applicantsModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Applicants: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @param string $applicantsId
     * @return ApplicantsInterface
     * @throws NoSuchEntityException
     */
    public function get(string $applicantsId): ApplicantsInterface
    {
        $applicants = $this->applicantsFactory->create();
        $this->resource->load($applicants, $applicantsId);
        if (!$applicants->getId()) {
            throw new NoSuchEntityException(__('Applicants with id "%1" does not exist.', $applicantsId));
        }
        return $applicants;
    }
}

