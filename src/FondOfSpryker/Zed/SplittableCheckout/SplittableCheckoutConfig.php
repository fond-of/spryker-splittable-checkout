<?php

namespace FondOfSpryker\Zed\SplittableCheckout;

use FondOfSpryker\Shared\SplittableCheckout\SplittableCheckoutConstants;
use Spryker\Zed\Kernel\AbstractBundleConfig;

class SplittableCheckoutConfig extends AbstractBundleConfig
{
    /**
     * @return string
     */
    public function getQuoteSplitQuoteItemAttribute(): string
    {
        return $this->get(SplittableCheckoutConstants::QUOTE_SPLIT_QUOTE_ITEM_ATTRIBUTE, '');
    }
}
