<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Model\Queue\Consumer;

use Employer\Recruitment\Api\ApplicantsRepositoryInterface;
use Employer\Recruitment\Api\Data\ApplicantsInterface;
use Employer\Recruitment\Helper\Settings;
use Employer\Recruitment\Model\Queue\Consumer;
use Exception;
use Magento\Framework\Serialize\Serializer\Json;

class Applications extends Consumer
{

    /**
     * @param Settings $settings
     * @param Json $json
     * @param ApplicantsRepositoryInterface $applicantsRepository
     * @param ApplicantsInterface $applicantsInterface
     */
    public function __construct(
        protected Settings                      $settings,
        protected Json                          $json,
        protected ApplicantsRepositoryInterface $applicantsRepository,
        protected ApplicantsInterface           $applicantsInterface
    )
    {
        parent::__construct($settings, $json);
    }

    /**
     * @param $message
     * @return void
     * @throws Exception
     */
    public function processApplication($message): void
    {
        $this->settings->isEnabled();
        $applicationData = $this->getMessageData($message);
        $applicant = $this->applicantsInterface;
        $applicant->setName($applicationData['name']);
        $applicant->setPosition($applicationData['position']);
        $applicant->setDecision($this->getDecision($applicationData['name']));
        try {
            $this->applicantsRepository->save($applicant);
        } catch (Exception $e) {
            $this->settings->logError(__('Unable to save application because %1', $e->getMessage()));
            #ray($e->getMessage());
        }
    }

    /**
     * @param $name
     * @return string
     */
    protected function getDecision($name): string
    {
        //TODO: Decision logic
        if ($name === 'Dan')
            return 'Successful';
        return 'Unsuccessful';
    }

}
