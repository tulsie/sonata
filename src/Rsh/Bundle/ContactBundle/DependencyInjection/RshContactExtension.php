<?php

namespace Rsh\Bundle\ContactBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class RshContactExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.xml');
        $loader->load('controller.xml');
        $this->configureMailer($container, $config, $loader);
    }

    /**
     * Configures the mailer service
     *
     * @param ContainerBuilder $container A container builder instance
     * @param array            $config    An array of configuration
     * @param XmlFileLoader    $loader    An XML file loader instance
     */
    private function configureMailer(ContainerBuilder $container, array $config, Loader\XmlFileLoader $loader)
    {
        $container->setAlias('mremi_contact.mailer', $config['email']['mailer']);

        if ('mremi_contact.mailer.twig_swift' !== $config['email']['mailer']) {
            return;
        }

        $loader->load('mailer.xml');

        $from = array();

        foreach ($config['email']['from'] as $data) {
            $from[$data['address']] = isset($data['name']) ? $data['name'] : null;
        }

        $definition = $container->findDefinition('mremi_contact.mailer');
        $definition->replaceArgument(2, $config['email']['recipient_address']);
        $definition->replaceArgument(3, $config['email']['template']);
        $definition->replaceArgument(4, $from);
    }
}
