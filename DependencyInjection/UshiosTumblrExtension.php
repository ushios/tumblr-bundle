<?php

namespace Ushios\Bundle\TumblrBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\DependencyInjection\Definition;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class UshiosTumblrExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        if (!empty($config['client'])){
            $this->clientSettings($config['client'], $container);
        }

        $loader->load('services.yml');
    }

    /**
     * Reading the config.yml for aws-sdk client.
     * @param array $configs
     * @param ContainerBuilder $container
     */
    protected function clientSettings(array $configs, ContainerBuilder $container)
    {
        foreach($configs as $key => $infos){
            $clientDefinition = new Definition();
            $clientDefinition->setClass($infos['class']);

            $clientDefinition->setArguments(array(
                    $infos['consumerKey'],
                    $infos['consumerSecret']
            ));
            
            if( isset($infos['token']) && isset($infos['tokenSecret']) ){
                $clientDefinition->addMethodCall('setToken',array(
                        $infos['token'],
                        $infos['tokenSecret']
                ));
            }

            $clientServiceId = 'ushios_tumblr_client';
            if ($key == 'default'){
                $container->setDefinition($clientServiceId, $clientDefinition);
                $clientServiceId = $clientServiceId.'.default';
            }else{
                $clientServiceId = $clientServiceId.'.'.$key;
            }

            $container->setDefinition($clientServiceId, $clientDefinition);
        }
    }
}
