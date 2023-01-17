<?php
namespace Futo\Budget;

use Dotenv\Dotenv;
use DI\ContainerBuilder;
use DI\Bridge\Slim\Bridge;
use Futo\Budget\Routes\BudgetRoute;
use Futo\Budget\Routes\IndexRoute;
use Futo\Budget\Routes\ReportRoute;
use Futo\Budget\Routes\TransactionRoute;

class App {
  public static function start() {
    Dotenv::createImmutable(dirname(__DIR__))->safeLoad();

    $containerBuilder = new ContainerBuilder;

    $containerBuilder->addDefinitions(__DIR__.'/Configs.php');

    $app = Bridge::create($containerBuilder->build());

    $app->group('/', IndexRoute::class);

    $app->group('/budgets', BudgetRoute::class);

    $app->group('/transactions', TransactionRoute::class);

    $app->group('/reports', ReportRoute::class);

    $app->addErrorMiddleware(true, true, true);

    // $errorMiddleware->setDefaultErrorHandler(ErrorHandler::class);

    $app->run();
  }
}
