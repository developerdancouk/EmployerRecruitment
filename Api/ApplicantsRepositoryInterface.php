<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Api;

use Employer\Recruitment\Api\Data\ApplicantsInterface;
use Employer\Recruitment\Api\Data\ApplicantsSearchResultsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;

interface ApplicantsRepositoryInterface
{

    /**
     * @param ApplicantsInterface $applicants
     * @return ApplicantsInterface
     * @throws LocalizedException
     */
    public function save(
        ApplicantsInterface $applicants
    );

    /**
     * @param string $applicantsId
     * @return ApplicantsInterface
     * @throws LocalizedException
     */
    public function get(string $applicantsId): ApplicantsInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return ApplicantsSearchResultsInterface
     * @throws LocalizedException
     */
    public function getList(
        SearchCriteriaInterface $searchCriteria
    ): ApplicantsSearchResultsInterface;

    /**
     * @param ApplicantsInterface $applicants
     * @return bool
     * @throws LocalizedException
     */
    public function delete(
        ApplicantsInterface $applicants
    ): bool;

    /**
     * @param string $applicantsId
     * @return bool
     * @throws NoSuchEntityException
     * @throws LocalizedException
     */
    public function deleteById(string $applicantsId): bool;
}

