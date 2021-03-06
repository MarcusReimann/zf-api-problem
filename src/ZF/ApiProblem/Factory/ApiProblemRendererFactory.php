<?php
/**
 * @license   http://opensource.org/licenses/BSD-3-Clause BSD-3-Clause
 * @copyright Copyright (c) 2013 Zend Technologies USA Inc. (http://www.zend.com)
 */

namespace ZF\ApiProblem\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\ApiProblem\View\ApiProblemRenderer;

class ApiProblemRendererFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return ApiProblemRenderer
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config            = $serviceLocator->get('Config');
        $displayExceptions = isset($config['view_manager'])
            && isset($config['view_manager']['display_exceptions'])
            && $config['view_manager']['display_exceptions'];

        $renderer = new ApiProblemRenderer();
        $renderer->setDisplayExceptions($displayExceptions);

        return $renderer;
    }
}
