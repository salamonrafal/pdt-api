<?php
namespace PDT\Configuration;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class ApplicationConfiguration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('application');


        $rootNode
            ->children()
                ->arrayNode('directories')
                    ->children()
                        ->scalarNode('documents')->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}