<?php
namespace PDT\Configuration;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\Yaml\Yaml;

class ServicesConfig
{
    private $processedConfiguration;

    public function __construct()
    {
        $config = Yaml::parse(
            $this->getConfigContent(__DIR__ . '/application.yaml')
        );

        $configs = array();

        array_push($configs, $config);

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
}