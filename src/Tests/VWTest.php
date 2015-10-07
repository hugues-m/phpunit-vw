<?php

namespace Tests;

use PHPUnit_Framework_TestCase;

/**
 * This will pass just fine on CI tools.
 *
 * Who cares about the legal limit ?
 *
 * @author Hugues Maignol <hugues@hmlb.fr>
 */
class VWTest extends PHPUnit_Framework_TestCase
{
    private $noxEmissions = 12000;

    private $legalLimit = 300;

    public function testEnvironmentalImpactCompliance()
    {
        $this->assertLessThan($this->legalLimit, $this->noxEmissions);
    }
}
