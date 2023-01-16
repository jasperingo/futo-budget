<?php
namespace Futo\Budget\Routes;

use Slim\Routing\RouteCollectorProxy;
use Futo\Budget\Guards\AuthGuard;
use Futo\Budget\Controllers\BudgetController;
use Futo\Budget\Validators\BudgetCreateValidator;

class BudgetRoute {
  public function __invoke(RouteCollectorProxy $route) {
    $route->get('', [BudgetController::class, 'index'])
      ->add(AuthGuard::class);

    $route->post('', [BudgetController::class, 'save'])
      ->add(BudgetCreateValidator::class)
      ->add(AuthGuard::class);
    
    $route->get('/create', [BudgetController::class, 'create'])
      ->add(AuthGuard::class);
  }
}
