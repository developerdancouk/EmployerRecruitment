<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */
declare(strict_types=1);

namespace Employer\Recruitment\Console\Command;

use Employer\Recruitment\Helper\Settings;
use Employer\Recruitment\Model\Queue\Publisher\Applications;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DummyData extends Command
{

    /**
     * @param Settings $settings
     * @param Applications $applications
     * @param array $applicantsData
     */
    public function __construct(
        protected Settings     $settings,
        protected Applications $applications,
        protected array        $applicantsData = [
            [
                'name' => 'Dan',
                'position' => 'Dev'
            ],
            [
                'name' => 'James',
                'position' => 'Dev'
            ],
            [
                'name' => 'Lewis',
                'position' => 'Dev'
            ]
        ]
    )
    {
        parent::__construct();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws Exception
     */
    protected function execute(
        InputInterface  $input,
        OutputInterface $output
    ): int
    {
        try {
            $this->settings->isEnabled();
        } catch (Exception $exception) {
            $output->writeln((string)__('Recruitment Module Disabled'));
            return 0;
        }
        foreach ($this->applicantsData as $applicantData) {
            $this->applications->import($applicantData);
        }
        $output->writeln((string)__('Dummy Data Added'));
        return 1;
    }

    /**
     * @return void
     */
    protected function configure(): void
    {
        $this->setName("employer_recruitment:dummy-data");
        $this->setDescription("Run some dummy data for the Job Application API");
        parent::configure();
    }
}

