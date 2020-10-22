<?php

namespace FondOfSpryker\Zed\SplittableCheckout\Business;

use FondOfSpryker\Zed\SplittableCheckout\Business\Model\QuoteSplitter;
use FondOfSpryker\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface;
use FondOfSpryker\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflow;
use FondOfSpryker\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
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
            $this->getSplittableCheckoutFacade(),
            $this->getQuoteFacade(),
            $this->createQuoteSplitter()
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

    /**
     * @return \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getPersistentCartFacade(): SplittableCheckoutToPersistentCartFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_PERSISTENT_CART);
    }

    /**
     * @return \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     *
     * @throws \Spryker\Zed\Kernel\Exception\Container\ContainerKeyNotFoundException
     */
    protected function getQuoteFacade(): SplittableCheckoutToQuoteFacadeInterface
    {
        return $this->getProvidedDependency(SplittableCheckoutDependencyProvider::FACADE_QUOTE);
    }

    /**
     * @return \FondOfSpryker\Zed\SplittableCheckout\Business\Model\QuoteSplitterInterface
     */
    protected function createQuoteSplitter(): QuoteSplitterInterface
    {
        return new QuoteSplitter(
            $this->getPersistentCartFacade(),
            $this->getConfig()
        );
    }
}
