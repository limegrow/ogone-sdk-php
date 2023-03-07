<?php
/*
 * @author Nicolas Clavaud <nicolas@lrqdo.fr>
 */

namespace Ogone\Tests\DirectLink;

use Ogone\DirectLink\DirectLinkMaintenanceResponse;

class DirectLinkMaintenanceResponseTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException InvalidArgumentException
     */
    public function CantExistWithoutXmlFile()
    {
        $maintenanceResponse = new DirectLinkMaintenanceResponse('');
    }

    /** @test
     * @throws \Exception
     */
    public function ParametersCanBeRetrieved()
    {
        $xml = $this->provideXML();

        $maintenanceResponse = new DirectLinkMaintenanceResponse($xml);
        $this->assertEquals('5', $maintenanceResponse->getParam('orderid'));
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @throws \Exception
     */
    public function RequestIsFilteredFromNonOgoneParameters()
    {
        $xml = $this->provideXML();

        $maintenanceResponse = new DirectLinkMaintenanceResponse($xml);
        $maintenanceResponse->getParam('unknown_param');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @throws \Exception
     */
    public function ChecksInvalidXml()
    {
        $xml = $this->provideInvalidXML();

        $maintenanceResponse = new DirectLinkMaintenanceResponse($xml);
    }

    /** @test
     * @throws \Exception
     */
    public function ChecksStatus()
    {
        $xml = $this->provideXML();

        $maintenanceResponse = new DirectLinkMaintenanceResponse($xml);
        $this->assertTrue($maintenanceResponse->isSuccessful());
    }

    /** @test
     * @throws \Exception
     */
    public function AmountIsConvertedToCent()
    {
        $xml = $this->provideXML();

        $maintenanceResponse = new DirectLinkMaintenanceResponse($xml);
        $this->assertEquals(100, $maintenanceResponse->getParam('amount'));
    }

    public function provideFloats(): array
    {
        return [['17.89', 1789], ['65.35', 6535], ['12.99', 1299]];
    }

    /**
     * @test
     * @dataProvider provideFloats
     * @throws \Exception
     */
    public function CorrectlyConvertsFloatAmountsToInteger($string, $integer)
    {
        $xml = $this->provideXML($string);

        $maintenanceResponse = new DirectLinkMaintenanceResponse($xml);
        $this->assertEquals($integer, $maintenanceResponse->getParam('amount'));
    }

    /**
     * Helper method to setup an xml-string
     */
    private function provideXML($amount = null): string
    {

        return '<?xml version="1.0"?>
                <ncresponse
                orderID="5"
                PAYID="33146134"
                NCERROR="0"
                NCERRORPLUS="!"
                ACCEPTANCE=""
                STATUS="91"
                AMOUNT="'.($amount ?: '1').'"
                CURRENCY="GBP">
                </ncresponse>';
    }

    /**
     * Helper method to setup an invalid xml-string
     */
    private function provideInvalidXML(): string
    {
        return '<?xml version="1.0"?>
                <ncresponse
                </ncresponse>';
    }
}
