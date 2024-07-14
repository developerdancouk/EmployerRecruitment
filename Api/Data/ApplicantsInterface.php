<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Api\Data;

interface ApplicantsInterface
{

    const string POSITION = 'Position';
    const string DECISION = 'Decision';
    const string APPLICANTS_ID = 'applicants_id';
    const string NAME = 'Name';

    /**
     * @return string|null
     */
    public function getApplicantsId(): ?string;

    /**
     * @param string $applicantsId
     * @return ApplicantsInterface
     */
    public function setApplicantsId($applicantsId): ApplicantsInterface;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param string $name
     * @return ApplicantsInterface
     */
    public function setName(string $name): ApplicantsInterface;

    /**
     * @return string|null
     */
    public function getPosition();

    /**
     * @param string $position
     * @return ApplicantsInterface
     */
    public function setPosition(string $position): ApplicantsInterface;

    /**
     * @return string|null
     */
    public function getDecision(): ?string;

    /**
     * @param string $decision
     * @return ApplicantsInterface
     */
    public function setDecision(string $decision): ApplicantsInterface;
}

