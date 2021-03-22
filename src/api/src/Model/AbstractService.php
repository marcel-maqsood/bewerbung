<?php
namespace api\Model;

use Depa\Core\Singleton;

abstract class AbstractService extends Singleton
{

    private static $instance;

    protected static $databaseConnection;

    protected function __construct($databaseConnection)
    {
        self::setDatabaseConnection($databaseConnection);
    }

    /**
     * Setzt die Datenbankverbindung
     *
     * @param \Zend\Db\Adapter\Adapter $databaseConnection            
     */
    public static function setDatabaseConnection($databaseConnection)
    {
        self::$databaseConnection = $databaseConnection;
    }

    public static function getDatabaseConnection()
    {
        return self::$databaseConnection;
    }
}

?>