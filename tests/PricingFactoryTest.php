<?php

/**
 * @coversDefaultClass PricingFactory
 */
class PricingFactoryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::unitPrice
     * @uses UnitPrice::__construct
     * @uses UnitPrice::setPrice
     * @uses UnitPrice::setQty
     * @uses UnitPrice::setKey
     */
    public function testUnitPrice()
    {
        $pricing_factory = new PricingFactory();
        $this->assertInstanceOf("UnitPrice", $pricing_factory->unitPrice(5.00, 2));
    }

    /**
     * @covers ::itemPrice
     * @uses ItemPrice::__construct
     * @uses ItemPrice::resetDiscountSubtotal
     * @uses ItemPrice::subtotal
     * @uses UnitPrice::__construct
     * @uses UnitPrice::setPrice
     * @uses UnitPrice::setQty
     * @uses UnitPrice::setKey
     * @uses UnitPrice::total
     */
    public function testItemPrice()
    {
        $pricing_factory = new PricingFactory();
        $this->assertInstanceOf("ItemPrice", $pricing_factory->itemPrice(5.00, 2));
    }

    /**
     * @covers ::discountPrice
     * @uses DiscountPrice::__construct
     * @uses AbstractPriceModifier::__construct
     */
    public function testDiscountPrice()
    {
        $pricing_factory = new PricingFactory();
        $this->assertInstanceOf("DiscountPrice", $pricing_factory->discountPrice(20.00, 'percent'));
    }

    /**
     * @covers ::taxPrice
     * @uses TaxPrice::__construct
     * @uses AbstractPriceModifier::__construct
     */
    public function testTaxPrice()
    {
        $pricing_factory = new PricingFactory();
        $this->assertInstanceOf("TaxPrice", $pricing_factory->taxPrice(7.75, 'exclusive'));
    }

    /**
     * @covers ::itemPriceCollection
     */
    public function testItemPriceCollection()
    {
        $pricing_factory = new PricingFactory();
        $this->assertInstanceOf("ItemPriceCollection", $pricing_factory->itemPriceCollection());
    }

    /**
     * @covers ::itemComparator
     * @uses AbstractItemComparator::__construct
     * @uses AbstractItemComparator::setPriceCallback
     * @uses AbstractItemComparator::setDescriptionCallback
     */
    public function testItemComparator()
    {
        $price_callback = function() {
            return 0;
        };
        $desc_callback = function() {
            return '';
        };

        $pricing_factory = new PricingFactory();
        $this->assertInstanceOf(
            "ItemComparator",
            $pricing_factory->itemComparator($price_callback, $desc_callback)
        );
    }
}
