<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */
declare(strict_types=1);

namespace Employer\Recruitment\Model;

use Employer\Recruitment\Api\Data\ApplicantsInterface;
use Magento\Framework\Model\AbstractModel;

class Applicants extends AbstractModel implements ApplicantsInterface
{


    /**
     * @return void
     */
    public function _construct(): void
    {
        $this->_init(ResourceModel\Applicants::class);
    }


    /**
     * @return string|null
     */
    public function getApplicantsId(): ?string
    {
        return $this->getData(self::APPLICANTS_ID);
    }

    /**
     * @param $applicantsId
     * @return ApplicantsInterface
     */
    public function setApplicantsId($applicantsId): ApplicantsInterface
    {
        return $this->setData(self::APPLICANTS_ID, $applicantsId);
    }


    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->getData(self::NAME);
    }

    /**
     * @param string $name
     * @return ApplicantsInterface
     */
    public function setName(string $name): ApplicantsInterface
    {
        return $this->setData(self::NAME, $name);
    }


    /**
     * @return array|mixed|string|null
     */
    public function getPosition(): mixed
    {
        return $this->getData(self::POSITION);
    }

    /**
     * @param string $position
     * @return ApplicantsInterface
     */
    public function setPosition(string $position): ApplicantsInterface
    {
        return $this->setData(self::POSITION, $position);
    }

    /**
     * @return string|null
     */
    public function getDecision(): ?string
    {
        return $this->getData(self::DECISION);
    }

    /**
     * @param string $decision
     * @return ApplicantsInterface
     */
    public function setDecision(string $decision): ApplicantsInterface
    {
        return $this->setData(self::DECISION, $decision);
    }
}

