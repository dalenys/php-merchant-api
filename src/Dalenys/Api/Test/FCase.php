<?php

use PHPUnit\Framework\TestCase;

/**
 * Functional test tools
 *
 * @package Dalenys\Test
 * @author Jérémy Cohen Solal <jeremy@dalenys.com>
 */

/**
 * Test base class for functionnal testing
 *
 * Handle IDENTIFIER, PASSWORD, Client instanciation and test tools
 */
abstract class Dalenys_Api_Test_FCase extends TestCase
{
    /**
     * API Directlink client
     * @var Dalenys_Api_DirectLinkClient
     */
    protected $api;

    /**
     * Test tools
     * @var Dalenys_Api_Test_Tools
     */
    protected $tools;

    /**
     * Get Dalenys identifier
     * @return string identifier
     */
    abstract protected function getIdentifier();

    /**
     * Get Dalenys password
     * @return mixed
     */
    abstract protected function getPassword();

    /**
     * Instanciate
     */
    public function __construct()
    {
        parent::__construct();

        $this->api   = Dalenys_Api_ClientBuilder::buildSandboxDirectLinkClient(
            $this->getIdentifier(),
            $this->getPassword()
        );
        $this->tools = new Dalenys_Api_Test_Tools();
    }

    /**
     * Test a succeeded transaction
     *
     * @param array $params
     */
    protected function assertTransactionSucceeded(array $params = array())
    {
        $this->assertEquals($params['EXECCODE'], '0000', 'Transaction failed with message ' . $params['MESSAGE']);
    }
}
