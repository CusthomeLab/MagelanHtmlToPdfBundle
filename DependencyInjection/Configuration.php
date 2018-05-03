<?php

namespace Magelan\HtmlToPdfBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('magelan_html_to_pdf');
        $rootNode
            ->children()
                ->scalarNode('entrypoint')
                    ->info('The htmltopdf endpoint')
                    ->isRequired()
                    ->cannotBeEmpty()
                ->end()
                ->arrayNode('settings')
                    ->useAttributeAsKey('name')
                    ->arrayPrototype()
                        ->variablePrototype()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
