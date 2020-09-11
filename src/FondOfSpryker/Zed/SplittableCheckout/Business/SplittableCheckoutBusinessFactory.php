<?php

namespace FondOfSpryker\Zed\SplittableCheckout\Business;

use FondOfSpryker\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow;
use FondOfSpryker\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfSpryker\Zed\SplittableCheckout\SplittableCheckoutDependencyProvider;
use Spryker\Zed\SplittableCheckout\Business\Workflow\CheckoutWorkflow;
use Spryker\Zed\Kernel\Business\AbstractBusinessFactory;

/**
 * @method \FondOfSpryker\Zed\SplittableCheckout\SplittableCheckoutConfig getConfig()
 */
class SplittableCheckoutBusinessFactory extends AbstractBusinessFactory
{
    /**
     * @return \FondOfSpryker\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface
     */
    public function createSplittableCheckoutWorkflow(): SplittableCheckoutWorkflowInterface
    {
        return new SplittableCheckoutWorkflow(
            $this->getSplittableCheckoutFacade()
        );
    }

    /**
     * @return \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getSplittableCheckoutFacade(): SplittableCheckoutToCheckoutFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_CHECKOUT);
    }
}
