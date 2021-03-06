<?php

namespace FondOfSpryker\Zed\SplittableCheckout;

use Codeception\Test\Unit;
use FondOfSpryker\Shared\CompanyTypeRole\CompanyTypeRoleConstants;
use FondOfSpryker\Shared\SplittableCheckout\SplittableCheckoutConstants;

class SplittableCheckoutConfigTest extends Unit
{
    /**
     * @var \FondOfSpryker\Zed\SplittableCheckout\SplittableCheckoutConfig|\PHPUnit\Framework\MockObject\MockObject
     */
    protected $splittableCheckoutConfig;

    /**
     * @return void
     */
    protected function _before(): void
    {
        parent::_before();

        $this->splittableCheckoutConfig = new class()
            extends SplittableCheckoutConfig {

            /**
             * @param string $key
             * @param mixed|null $default
             *
             * @return mixed
             */
            protected function get($key, $default = null)
            {
                if ($key === SplittableCheckoutConstants::QUOTE_SPLIT_QUOTE_ITEM_ATTRIBUTE) {
                    return 'split_attribute';
                }

                return parent::get($key, $default);
            }
        };
    }

    /**
     * @return void
     */
    public function testGetQuoteSplitQuoteItemAttribute(): void
    {
        $attribute = $this->splittableCheckoutConfig->getQuoteSplitQuoteItemAttribute();

        $this->assertEquals('split_attribute', $attribute);
    }
}
