<?php

namespace EnhancedProxy_a824179c1a036fc0f790305a7cf36f82413e0d6a\__CG__\Raf\SiteBundle\Controller;

/**
 * CG library enhanced proxy class.
 *
 * This code was generated automatically by the CG library, manual changes to it
 * will be lost upon next generation.
 */
class BlogController extends \Raf\SiteBundle\Controller\BlogController
{
    private $__CGInterception__loader;

    public function ajouterAction()
    {
        $ref = new \ReflectionMethod('Raf\\SiteBundle\\Controller\\BlogController', 'ajouterAction');
        $interceptors = $this->__CGInterception__loader->loadInterceptors($ref, $this, array());
        $invocation = new \CG\Proxy\MethodInvocation($ref, $this, array(), $interceptors);

        return $invocation->proceed();
    }

    public function __CGInterception__setLoader(\CG\Proxy\InterceptorLoaderInterface $loader)
    {
        $this->__CGInterception__loader = $loader;
    }
}