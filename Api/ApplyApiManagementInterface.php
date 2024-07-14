<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Api;

interface ApplyApiManagementInterface
{

    /**
     * @param string $name
     * @param string $position
     * @return string|null
     */
    public function postApply(string $name, string $position): ?string;
}

