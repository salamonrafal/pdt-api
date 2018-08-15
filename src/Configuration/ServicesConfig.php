<?php
namespace PDT\Configuration;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class ServicesConfig
{
    private $processedConfiguration;

    public function __construct()
    {
        $configs = array();

        array_push($configs, $this->getConfiguration());
        array_push($configs, $this->getOSconfiguration());

        $processor = new Processor();
        $applicationConfiguration = new ApplicationConfiguration();
        $this->processedConfiguration = $processor->processConfiguration($applicationConfiguration, $configs);
    }

    public function getConfig()
    {
        return $this->processedConfiguration;
    }

    private function getConfigContent (string $filename): string
    {
        return file_get_contents($filename);
    }

    private function getConfiguration()
    {
        $config = Yaml::parse(
            $this->getConfigContent(__DIR__ . '/application.yaml')
        );

        return $config;
    }

    private function getOSconfiguration()
    {
        switch (PHP_OS)
        {
            case 'WINNT':
                return Yaml::parse(
                    $this->getConfigContent(__DIR__ . '/application_win.yaml')
                );
            break;
            default:
                return [];
        }
    }
}