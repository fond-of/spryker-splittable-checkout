<?php

namespace FondOfSpryker\Zed\SplittableCheckout;

use Codeception\Test\Unit;
use FondOfSpryker\Zed\ProductListCompany\ProductListCompanyDependencyProvider;
use FondOfSpryker\Zed\SplittableCheckout\Business\SplittableCheckoutBusinessFactory;
use FondOfSpryker\Zed\SplittableCheckout\Business\Workflow\SplittableCheckoutWorkflowInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface;
use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface;
use Spryker\Zed\Kernel\Container;

class SplittableCheckoutBusinessFactoryTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Client\Kernel\Container
     */
    protected $containerMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SplittableCheckout\SplittableCheckoutConfig
     */
    protected $configMock;

    /**
     * @var \FondOfSpryker\Zed\SplittableCheckout\Business\SplittableCheckoutBusinessFactory
     */
    protected $splittableCheckoutBusinessFactory;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $splittableCheckoutToCheckoutFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeInterface
     */
    protected $splittableCheckoutToQuoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToPersistentCartFacadeInterface
     */
    protected $splittableCheckoutToPersistentCartFacadeInterface;

    /**
     * @return void
     */
    protected function _before(): void
    {
        $this->containerMock = $this->getMockBuilder(Container::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->configMock = $this->getMockBuilder(SplittableCheckoutConfig::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToCheckoutFacadeMock = $this->getMockBuilder(SplittableCheckoutToCheckoutFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToQuoteFacadeMock = $this->getMockBuilder(SplittableCheckoutToQuoteFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToPersistentCartFacadeMock = $this->getMockBuilder(SplittableCheckoutToPersistentCartFacadeInterface::class)
            ->disableOriginalConstructor()
            ->getMock();


        $this->splittableCheckoutBusinessFactory = new SplittableCheckoutBusinessFactory();
        $this->splittableCheckoutBusinessFactory->setContainer($this->containerMock);
        $this->splittableCheckoutBusinessFactory->setConfig($this->configMock);
    }

    /**
     * @return void
     */
    public function testCreateSplittableCheckoutWorkflow(): void
    {

        $this->containerMock->expects($this->atLeastOnce())
            ->method('has')
            ->willReturn(true);

        $this->containerMock->expects($this->atLeastOnce())
            ->method('get')
            ->withConsecutive(
                [SplittableCheckoutDependencyProvider::FACADE_CHECKOUT],
                [SplittableCheckoutDependencyProvider::FACADE_QUOTE],
                [SplittableCheckoutDependencyProvider::FACADE_PERSISTENT_CART]
            )
            ->willReturnOnConsecutiveCalls(
                $this->splittableCheckoutToCheckoutFacadeMock,
                $this->splittableCheckoutToQuoteFacadeMock,
                $this->splittableCheckoutToPersistentCartFacadeMock
            );

        $this->assertInstanceOf(
            SplittableCheckoutWorkflowInterface::class,
            $this->splittableCheckoutBusinessFactory->createSplittableCheckoutWorkflow()
        );
    }
}
