<?php

namespace Phive\Queue\Tests\Queue;

trait PersistenceTrait
{
    /**
     * @var \Phive\Queue\Tests\Handler\Handler
     */
    private static $handler;

    /**
     * @return \Phive\Queue\Queue\Queue
     */
    public function createQueue()
    {
        return self::getHandler()->createQueue();
    }

    /**
     * Abstract static class functions are not supported since v5.2.
     *
     * @param array $config
     *
     * @return \Phive\Queue\Tests\Handler\Handler
     *
     * @throws \BadMethodCallException
     */
    public static function createHandler(array $config)
    {
        throw new \BadMethodCallException(
            sprintf('Method %s:%s is not implemented.', get_called_class(), __FUNCTION__)
        );
    }

    public static function getHandler()
    {
        if (!self::$handler) {
            self::$handler = static::createHandler($_ENV);
        }

        return self::$handler;
    }

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        self::getHandler()->reset();
    }

    public static function tearDownAfterClass()
    {
        parent::tearDownAfterClass();

        self::$handler = null;
    }

    protected function setUp()
    {
        parent::setUp();

        self::getHandler()->clear();
    }
}
