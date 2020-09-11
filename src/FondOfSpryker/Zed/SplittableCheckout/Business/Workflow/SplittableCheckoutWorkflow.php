<?php

namespace FondOfSpryker\Zed\SplittableCheckout\Business\Workflow;

use FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface;
use Generated\Shared\Transfer\CheckoutResponseTransfer;
use Generated\Shared\Transfer\QuoteTransfer;
use Generated\Shared\Transfer\SaveOrderTransfer;
use Generated\Shared\Transfer\SplittableCheckoutResponseTransfer;
use Spryker\Zed\Checkout\Dependency\Facade\CheckoutToOmsFacadeInterface;
use Spryker\Zed\Checkout\Dependency\Plugin\CheckoutPreSaveHookInterface;
use Spryker\Zed\Checkout\Dependency\Plugin\CheckoutSaveOrderInterface as ObsoleteCheckoutSaveOrderInterface;
use Spryker\Zed\PropelOrm\Business\Transaction\DatabaseTransactionHandlerTrait;

class SplittableCheckoutWorkflow implements SplittableCheckoutWorkflowInterface
{
    /**
     * @var \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface
     */
    protected $checkoutFacade;

    /**
     * SplittableCheckoutWorkflow constructor.
     *
     * @param \FondOfSpryker\Zed\SplittableCheckout\Dependency\Facade\SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
     */
    public function __construct(
        SplittableCheckoutToCheckoutFacadeInterface $checkoutFacade
    ) {
        $this->checkoutFacade = $checkoutFacade;
    }

    /**
     * @param \Generated\Shared\Transfer\QuoteTransfer $quoteTransfer
     *
     * @return \Generated\Shared\Transfer\SplittableCheckoutResponseTransfer
     */
    public function placeOrder(QuoteTransfer $quoteTransfer): SplittableCheckoutResponseTransfer
    {
        $checkoutResponseTransfer = $this->checkoutFacade->placeOrder($quoteTransfer);

        $splittableCheckoutResponseTransfer = (new SplittableCheckoutResponseTransfer())->toArray($checkoutResponseTransfer->fromArray());

        return $checkoutResponseTransfer;
    }

}
