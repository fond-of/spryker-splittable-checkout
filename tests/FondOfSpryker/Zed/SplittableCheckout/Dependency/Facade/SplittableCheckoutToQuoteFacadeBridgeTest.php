<?php

namespace FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade;

use Codeception\Test\Unit;
use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Spryker\Zed\Quote\Business\QuoteFacade;

class SplittableCheckoutToQuoteFacadeBridgeTest extends Unit
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Spryker\Zed\Quote\Business\QuoteFacade
     */
    protected $quoteFacadeMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteTransfer
     */
    protected $quoteTransferMock;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|\Generated\Shared\Transfer\QuoteResponseTransfer
     */
    protected $quoteResponseTransferMock;

    /**
     * @var \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToQuoteFacadeBridge
     */
    protected $splittableCheckoutToQuoteFacadeBridge;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->quoteFacadeMock = $this->getMockBuilder(QuoteFacade::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteTransferMock = $this->getMockBuilder(QuoteTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->quoteResponseTransferMock = $this->getMockBuilder(QuoteResponseTransfer::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->splittableCheckoutToQuoteFacadeBridge = new SplittableCheckoutToQuoteFacadeBridge(
            $this->quoteFacadeMock
        );
    }

    /**
     * @return void
     */
    public function testDeleteQuote(): void
    {
        $this->quoteFacadeMock->expects($this->atLeastOnce())
            ->method('deleteQuote')
            ->with($this->quoteTransferMock)
            ->willReturn($this->quoteResponseTransferMock);

        $quoteResponseTransfer = $this->splittableCheckoutToQuoteFacadeBridge
            ->deleteQuote($this->quoteTransferMock);

        $this->assertInstanceOf(
            QuoteResponseTransfer::class,
            $quoteResponseTransfer
        );
    }
}
