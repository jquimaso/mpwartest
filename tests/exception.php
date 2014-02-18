<?php


class ExceptionTest extends PHPUnit_Framework_TestCase
{
    /**
     * @expectedException           InvalidArgumentException
     * @expectedExceptionMessage    Right Message
     */
    public function testExceptionMensaje()
    {
        /**
         *  error perque hi ha un "Some Message" en el codi i hem definit un "Right Message" a la capçalera
         * */
        throw new InvalidArgumentException ("Some Message",10);

    }


    /**
     * @expectedException           InvalidArgumentException
     * @expectedExceptionCode    10
     */
    public function testExceptionCodigo()
    {
        /**
         *  error perque hi ha un 20 en el codi i hem definit un 10 a la capçalera
         * */
        throw new InvalidArgumentException ("Some Message",20);

    }


}