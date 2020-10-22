<?php

namespace FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade;

use Generated\Shared\Transfer\QuoteResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;

interface SplittableCheckoutToQuoteFacadeInterface
{
    /**
     * @param \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\QuoteTransfer $quoteTransfer
     *
     * @return \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\QuoteResponseTransfer
     */
    public function deleteQuote(QuoteTransfer $quoteTransfer): QuoteResponseTransfer;
}
