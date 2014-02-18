<?php

include_once __DIR__ . '/../src/Money.php';

class MoneyTest extends PHPUnit_Framework_TestCase
{
    /*para que el test se ejecute SEIMPRE DEBE EMPEZAR para que se ejecute test.......*/
    public function testCanBeNegated()
    {
        // Arrange
        $a = new Money(1);
        // Act
        $b = $a->negate();
        // Assert
        $this->assertEquals(-1, $b->getAmount());
    }
}