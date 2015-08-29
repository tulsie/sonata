<?php

namespace Rsh\Bundle\ContactBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('rsh_contact');

        $rootNode
            ->children()
                ->arrayNode('email')
                    ->isRequired()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('mailer')->defaultValue('mremi_contact.mailer.twig_swift')->cannotBeEmpty()->end()
                        ->arrayNode('from')
                            ->prototype('array')
                                ->children()
                                    ->scalarNode('address')->cannotBeEmpty()->isRequired()->end()
                                    ->scalarNode('name')->end()
                                ->end()
                            ->end()
                        ->end()
                        ->scalarNode('recipient_address')->isRequired()->cannotBeEmpty()->end()
                        ->scalarNode('template')->defaultValue('MremiContactBundle:Contact:email.txt.twig')->cannotBeEmpty()->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
