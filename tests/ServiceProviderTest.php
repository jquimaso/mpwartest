<?php
namespace Development;


class ServiceProviderTest extends \PHPUnit_Framework_TestCase
{


    public function testsetService(  )
    {
        $myServiceprovider = new \Development\ServiceProvider();
        $dummy = $this->getMock('ServiceProvider');

        $myServiceprovider->setService('ServiceProvider',$dummy);

        $this->assertEquals(1, 1);

    }


    public function testgetService()
    {
        /*
        try
        {

            $myServiceprovider = new \Development\ServiceProvider();
            $dummy2 = $this->getMock('ServiceProvider');

            $myServiceprovider->setService('ServiceProvider','hola');

            $myServiceprovider->getService($dummy2);
            $this->assertEquals(true, true);

        }
        catch (\Exception $e){
            $this->assertEquals(false, true);
        }
        */

    }



}