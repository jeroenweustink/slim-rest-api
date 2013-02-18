<?php

namespace App;

use Slim\Slim;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache;
use Doctrine\ORM\EntityManager;

abstract class Resource
{
    const STATUS_OK = 200;
    const STATUS_CREATED = 201;
    const STATUS_ACCEPTED = 202;
    const STATUS_NO_CONTENT = 204;

    const STATUS_MULTIPLE_CHOICES = 300;
    const STATUS_MOVED_PERMANENTLY = 301;
    const STATUS_FOUND = 302;
    const STATUS_NOT_MODIFIED = 304;
    const STATUS_USE_PROXY = 305;
    const STATUS_TEMPORARY_REDIRECT = 307;

    const STATUS_BAD_REQUEST = 400;
    const STATUS_UNAUTHORIZED = 401;
    const STATUS_FORBIDDEN = 403;
    const STATUS_NOT_FOUND = 404;
    const STATUS_METHOD_NOT_ALLOWED = 405;
    const STATUS_NOT_ACCEPTED = 406;

    const STATUS_INTERNAL_SERVER_ERROR = 500;
    const STATUS_NOT_IMPLEMENTED = 501;

    /**
     * @var \Slim\Slim
     */
    private $slim;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->setSlim(Slim::getInstance());
        $this->setEntityManager();

        $this->init();
    }

    /**
     * Default init, use for overwrite only
     */
    public function init()
    {}

    /**
     * Default get method
     */
    public function get()
    {
        $this->response(self::STATUS_METHOD_NOT_ALLOWED);
    }

    /**
     * Default post method
     */
    public function post()
    {
        $this->response(self::STATUS_METHOD_NOT_ALLOWED);
    }

    /**
     * Default put method
     */
    public function put()
    {
        $this->response(self::STATUS_METHOD_NOT_ALLOWED);
    }

    /**
     * Default delete method
     */
    public function delete()
    {
        $this->response(self::STATUS_METHOD_NOT_ALLOWED);
    }

    /**
     * General options method
     */
    public function options()
    {
        $this->response(self::STATUS_METHOD_NOT_ALLOWED);
    }

    /**
     * @param int $status
     * @param array $data
     */
    public static function response($status = 200, array $data = array(), $allow = array())
    {
        /**
         * @var \Slim\Slim $slim
         */
        $slim = \Slim\Slim::getInstance();

        $slim->status($status);
        $slim->response()->header('Content-Type', 'application/json');

        if (!empty($data)) {
            $slim->response()->body(json_encode($data));
        }

        if (!empty($allow)) {
            $slim->response()->header('Allow', strtoupper(implode(',', $allow)));
        }

        return;
    }

    /**
     * @param $resource
     * @return mixed
     */
    public static function load($resource)
    {
        $class = __NAMESPACE__ . '\\Resource\\' . ucfirst($resource);
        if (!class_exists($class)) {
            return null;
        }

        return new $class();
    }

    /**
     * @return \Slim\Slim
     */
    public function getSlim()
    {
        return $this->slim;
    }

    /**
     * @param \Slim\Slim $slim
     */
    public function setSlim($slim)
    {
        $this->slim = $slim;
    }

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * Create a entity manager instance
     */
    public function setEntityManager()
    {
        $config = new Configuration();
        $config->setMetadataCacheImpl(new ArrayCache());
        $driverImpl = $config->newDefaultAnnotationDriver(array(__DIR__ . '/Entity'));
        $config->setMetadataDriverImpl($driverImpl);

        $config->setProxyDir(__DIR__ . '/Entity/Proxy');
        $config->setProxyNamespace('Proxy');

        $ini = parse_ini_file(__DIR__ . '/../../config/local.ini');
        $connectionOptions = array(
            'driver'   => $ini['driv'],
            'host'     => $ini['host'],
            'dbname'   => $ini['name'],
            'user'     => $ini['user'],
            'password' => $ini['pass'],
        );

        $this->entityManager = EntityManager::create($connectionOptions, $config);
    }
}