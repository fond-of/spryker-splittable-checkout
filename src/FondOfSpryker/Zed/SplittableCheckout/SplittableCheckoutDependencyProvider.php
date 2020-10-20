<?php

namespace FondOfSpryker\Zed\SplittableCheckout;

use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeBridge;
use Spryker\Zed\Kernel\AbstractBundleDependencyProvider;
use Spryker\Zed\Kernel\Container;

/**
 * @method \FondOfSpryker\Zed\SplittableCheckout\SplittableCheckoutConfig getConfig()
 */
class SplittableCheckoutDependencyProvider extends AbstractBundleDependencyProvider
{
    public const FACADE_CHECKOUT = 'FACADE_CHECKOUT';

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    public function provideBusinessLayerDependencies(Container $container)
    {
        exit('2');
        $container = $this->addCheckoutFacade($container);

        return $container;
    }

    /**
     * @param \Spryker\Zed\Kernel\Container $container
     *
     * @return \Spryker\Zed\Kernel\Container
     */
    protected function addCheckoutFacade(Container $container)
    {
        $container[static::FACADE_CHECKOUT] = function () use ($container) {
            return new SplittableCheckoutToCheckoutFacadeBridge($container->getLocator()->checkout()->facade());
        };

        return $container;
    }
}
