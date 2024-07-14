<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface ApplicantsSearchResultsInterface extends SearchResultsInterface
{

    /**
     * @return ApplicantsInterface[]
     */
    public function getItems(): array;

    /**
     * @param ApplicantsInterface[] $items
     * @return $this
     */
    public function setItems(array $items): static;
}

