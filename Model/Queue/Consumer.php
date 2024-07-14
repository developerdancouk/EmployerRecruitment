<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */

namespace Employer\Recruitment\Model\Queue;

use Employer\Recruitment\Helper\Settings;
use Magento\Framework\Serialize\Serializer\Json;

class Consumer
{
    public function __construct(
        protected Settings $settings,
        protected Json     $json
    )
    {
    }

    /**
     * @param $message
     * @return mixed
     */
    public function getMessageData($message): mixed
    {
        $message = (array)$this->json->unserialize($message);
        $type = array_key_first($message);
        return $message[$type];
    }

}
