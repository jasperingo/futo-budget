<?php
namespace Futo\Budget\Routes;

use Slim\Routing\RouteCollectorProxy;
use Futo\Budget\Guards\AuthGuard;
use Futo\Budget\Controllers\TransactionController;
use Futo\Budget\Validators\TransactionCreateValidator;

class TransactionRoute {
  public function __invoke(RouteCollectorProxy $route) {
    $route->get('', [TransactionController::class, 'index'])
      ->add(AuthGuard::class);

    $route->get('/create/income', [TransactionController::class, 'createIncome'])
      ->add(AuthGuard::class);

    $route->get('/create/expense', [TransactionController::class, 'createExpense'])
      ->add(AuthGuard::class);

    $route->post('', [TransactionController::class, 'save'])
      ->add(TransactionCreateValidator::class)
      ->add(AuthGuard::class);
  }
}
