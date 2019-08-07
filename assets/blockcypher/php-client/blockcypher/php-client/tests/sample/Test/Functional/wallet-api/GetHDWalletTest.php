<?php

namespace sample\Test\Functional\wallet;

use sample\Test\Functional\WalletSampleTestCase;

/**
 * Class GetHDWalletTest
 * @package sample\Test\Functional\wallet
 */
class GetHDWalletTest extends WalletSampleTestCase
{
    public function setUp()
    {
        parent::setUp();
        $className = $this->getClassName();
        $sampleName = substr($className, 0, -4);
        $this->url = self::baseUrl() . basename(__DIR__) . '/' . $sampleName . '.php';
    }

    /**
     * Returns just the classname of the test you are executing. It removes the namespaces.
     * @return string
     */
    public function getClassName()
    {
        return join('', array_slice(explode('\\', get_class($this)), -1));
    }

    public function testGetHDWallet()
    {
        $this->loadAndAssertSample($this->url . '?wallet_name=' . self::$walletName);
    }
}