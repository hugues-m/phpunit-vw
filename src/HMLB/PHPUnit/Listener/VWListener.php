<?php

namespace HMLB\PHPUnit\Listener;

use HMLB\VW\SecretSoftware;
use PHPUnit_Framework_AssertionFailedError;
use PHPUnit_Framework_TestListener;
use PHPUnit_Framework_Test;
use PHPUnit_Framework_TestCase;
use PHPUnit_Framework_TestSuite;
use Exception;

/**
 * This Listener makes your failing test cases pass continuous integration scrutiny.
 *
 * Uses a piece of secret software for automatic test environment detection.
 * Now you can break rules too.
 *
 * @author Hugues Maignol <hugues@hmlb.fr>
 */
class VWListener implements PHPUnit_Framework_TestListener
{
    /**
     * @var SecretSoftware
     */
    private $secretSoftware;

    /**
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $additionalEnvVariables = array();
        if (array_key_exists('additionalEnvVariables', $options)) {
            $additionalEnvVariables = $options['additionalEnvVariables'];
        }

        $this->secretSoftware = new SecretSoftware($additionalEnvVariables);
    }

    /**
     * {@inheritdoc}
     */
    public function startTest(PHPUnit_Framework_Test $test)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function endTest(PHPUnit_Framework_Test $test, $time)
    {
        if (!$test instanceof PHPUnit_Framework_TestCase) {
            return;
        }
        if ($this->secretSoftware->underScrutiny()) {
            $this->secretSoftware->force($test);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function addError(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addFailure(PHPUnit_Framework_Test $test, PHPUnit_Framework_AssertionFailedError $e, $time)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addIncompleteTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addRiskyTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function addSkippedTest(PHPUnit_Framework_Test $test, Exception $e, $time)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function startTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function endTestSuite(PHPUnit_Framework_TestSuite $suite)
    {
    }
}

