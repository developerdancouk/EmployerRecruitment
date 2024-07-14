<?php
/*
 * @Author:    Dan Lewis (dan.lewis@employer.tbc)
 * @Copyright: 2024 Employer (https://Employer.tbc)
 * @Package:   Employer_Recruitment
 */
declare(strict_types=1);

namespace Employer\Recruitment\Helper;

use Exception;
use Magento\Catalog\Model\Product;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class Settings extends AbstractHelper
{
    public const string LOG_PREFIX = "Employer - Recruitment";
    public const string MODULE_ENABLED = "recruitment/settings/enable";

    /**
     * @param Context $context
     * @param LoggerInterface $logger
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     * @param DirectoryList $directoryList
     * @param Filesystem $fileSystem
     * @param File $file
     * @param Product $product
     * @param WriterInterface $configWriter
     */
    public function __construct(
        public Context                  $context,
        protected LoggerInterface       $logger,
        ScopeConfigInterface            $scopeConfig,
        protected StoreManagerInterface $storeManager,
        protected DirectoryList         $directoryList,
        protected Filesystem            $fileSystem,
        protected File                  $file,
        protected Product               $product,
        protected WriterInterface       $configWriter
    )
    {
        parent::__construct($context);
    }

    /**
     * @param $config
     * @return mixed
     * @throws Exception
     */
    public function isEnabled($config = null): mixed
    {
        $status = $this->scopeConfig->getValue(self::MODULE_ENABLED, $this->getStoreScope());
        if (!$status) {
            $phrase = __('%1: Module Disabled', self::LOG_PREFIX);
            $this->logError((string)$phrase);
            throw new Exception((string)$phrase);
        }
        if ($config) {
            $status = $this->scopeConfig->getValue($config, $this->getStoreScope());
            if (!$status) {
                $phrase = __('%1: Configuration Disabled', self::LOG_PREFIX);
                $this->logError((string)$phrase);
                throw new Exception((string)$phrase);
            }
        }
        return $status;
    }

    /**
     * @return string
     */
    private function getStoreScope(): string
    {
        return ScopeInterface::SCOPE_STORE;
    }

    /**
     * @param string $message
     * @param $resource
     * @return void
     */
    public function logError(string $message = "", $resource = null): void
    {
        $this->logger->error(
            self::LOG_PREFIX .
            " - ERROR - " .
            $message
        );
    }

    /**
     * @param $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue($config, $this->getStoreScope());
    }

    /**
     * @param $config
     * @param $value
     * @return bool
     */
    public function setConfig($config, $value): bool
    {
        try {
            $this->configWriter->save($config, $value, $scope = ScopeConfigInterface::SCOPE_TYPE_DEFAULT, $scopeId = 0);
        } catch (Exception $exception) {
            $this->logError($exception->getMessage());
            return false;
        }
        return true;
    }
}

