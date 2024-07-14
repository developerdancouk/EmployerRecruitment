<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */
declare(strict_types=1);

namespace Employer\Recruitment\Model\ResourceModel\Applicants;

use Employer\Recruitment\Model\Applicants;
use Employer\Recruitment\Model\ResourceModel\Applicants as ResourceApplicants;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'applicants_id';

    /**
     * @return void
     */
    protected function _construct(): void
    {
        $this->_init(
            Applicants::class,
            ResourceApplicants::class
        );
    }
}

