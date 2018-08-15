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
                        ->scalarNode('cache_upload_pdf')->end()
                    ->end()
                ->end()

                ->arrayNode('supported_formats')
                    ->arrayPrototype()
                        ->children()
                        ->scalarNode('mime')->end()
                        ->scalarNode('type')->end()
                        ->end()
                    ->end()
                ->end()

                ->arrayNode('bin_location')
                    ->children()
                        ->scalarNode('pdftohtml_bin')->end()
                        ->scalarNode('pdfinfo_bin')->end()
                    ->end()
                ->end()

            ->end()
        ;

        return $treeBuilder;
    }
}