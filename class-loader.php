<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/symfony/class-loader/Symfony/Component/ClassLoader/UniversalClassLoader.php';

$loader = new Symfony\Component\ClassLoader\UniversalClassLoader();
$loader->registerNamespaces(array('App' => __DIR__ . '/src'));
$loader->registerNamespaces(array('Slim' => __DIR__ . '/vendor/slim/slim'));
$loader->registerNamespaces(array('Symfony\\Component\\ClassLoader' => __DIR__.'/vendor/symfony/class-loader'));
$loader->registerNamespaces(array('Symfony\\Component\\Console' => __DIR__.'/vendor/symfony/console'));
$loader->registerNamespaces(array('Doctrine\\Common' => __DIR__.'/vendor/doctrine/common/lib'));
$loader->registerNamespaces(array('Doctrine\\DBAL' => __DIR__.'/vendor/doctrine/common/lib'));
$loader->registerNamespaces(array('Doctrine\\ORM' => __DIR__.'/vendor/doctrine/orm/lib'));
$loader->register();