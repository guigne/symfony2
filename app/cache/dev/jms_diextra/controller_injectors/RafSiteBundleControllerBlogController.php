<?php

namespace Raf\SiteBundle\Controller;

/**
 * This code has been auto-generated by the JMSDiExtraBundle.
 *
 * Manual changes to it will be lost.
 */
class BlogController__JMSInjector
{
    public static function inject($container) {
        require_once '/var/www/raf/app/cache/dev/jms_diextra/proxies/Raf-SiteBundle-Controller-BlogController.php';
        $a = new \JMS\AopBundle\Aop\InterceptorLoader($container, array('Raf\\SiteBundle\\Controller\\BlogController' => array('ajouterAction' => array(0 => 'security.access.method_interceptor'))));
        $instance = new \EnhancedProxy_a824179c1a036fc0f790305a7cf36f82413e0d6a\__CG__\Raf\SiteBundle\Controller\BlogController();
        $instance->__CGInterception__setLoader($a);
        return $instance;
    }
}
