<?php
use Aura\Session\SessionFactory;
use Aura\Session\Segment as SessionSegment;
use Psr\Container\ContainerInterface;
use Slim\Views\PhpRenderer;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\Persistence\Mapping\Driver\StaticPHPDriver;

return [
  SessionSegment::class => function () {
    $sessionFactory = new SessionFactory;
    $session = $sessionFactory->newInstance($_COOKIE);
    return $session->getSegment('Futo\\Budget');
  },

  PhpRenderer::class => function (ContainerInterface $container, SessionSegment $session) {
    $renderer = new PhpRenderer(__DIR__ . '/views', [
      'user' => $session->get('user')
    ]);
    
    $renderer->setLayout('layout.php');
    return $renderer;
  },

  EntityManager::class => function() {
    $modelsDir = [__DIR__.'/Models'];

    $driver = new StaticPHPDriver($modelsDir);
    
    $config = ORMSetup::createAttributeMetadataConfiguration(
      $modelsDir,
      $_ENV['PHP_ENV'] === 'development'
    );

    $config->setMetadataDriverImpl($driver);

    $connection = DriverManager::getConnection([
      'host' => $_ENV['DB_HOST'],
      'driver' => $_ENV['DB_DRIVER'],
      'user' => $_ENV['DB_USERNAME'],
      'password' => $_ENV['DB_PASSWORD'],
      'dbname' => $_ENV['DB_DATABASE'],
    ], $config);

    return new EntityManager($connection, $config);
  }
];
