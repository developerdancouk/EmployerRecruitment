<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */
declare(strict_types=1);

namespace Employer\Recruitment\Model;

use Employer\Recruitment\Api\ApplyApiManagementInterface;
use Employer\Recruitment\Helper\Settings;
use Employer\Recruitment\Model\Queue\Publisher\Applications;
use Exception;
use Magento\Framework\Webapi\Rest\Request;

class ApplyApiManagement implements ApplyApiManagementInterface
{

    /**
     * @param Settings $settings
     * @param Request $request
     * @param Applications $applications
     */
    public function __construct(
        protected Settings     $settings,
        protected Request      $request,
        protected Applications $applications
    )
    {
    }

    /**
     * @param string $name
     * @param string $position
     * @return string|null
     * @throws Exception
     */
    public function postApply(string $name, string $position): ?string
    {
        try {
            $this->settings->isEnabled();
        } catch (Exception $exception) {
            return json_encode(['success' => false, 'message' => __('Position has been filled.')]);
        }
        $this->settings->isEnabled();
        if (empty($name) || empty($position)) {
            $this->settings->logError((string)__('Invalid Data'));
            return json_encode(['success' => false, 'message' => __('Invalid Data')]);
        }
        $this->applications->import(['name' => $name, 'position' => $position]);
        return json_encode(['success' => true, 'message' => __('Application successful')]);
    }
}

