<?php
/**
 * Created by PhpStorm.
 * User: Christoph
 * Date: 23.05.2018
 * Time: 10:05
 */

namespace App\SymfoniacNewsletterBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Config\FileLocator;


class SymfoniacNewsletterExtension extends Extension
{
    /**
     * Loads a specific configuration.
     *
     * @throws \InvalidArgumentException When provided tag is not defined in this extension
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('service.xml');

        $this->addAnnotatedClassesToCompile(array(
            '**\Bundle\Controller\NewsletterController',
        ));
    }


}