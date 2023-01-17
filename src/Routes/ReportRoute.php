<?php
namespace Futo\Budget\Routes;

use Slim\Routing\RouteCollectorProxy;
use Futo\Budget\Guards\AuthGuard;
use Futo\Budget\Controllers\ReportController;
use Futo\Budget\Validators\ReportCreateValidator;

class ReportRoute {
  public function __invoke(RouteCollectorProxy $route) {
    $route->get('', [ReportController::class, 'index'])
      ->add(AuthGuard::class);

    $route->post('', [ReportController::class, 'save'])
      ->add(ReportCreateValidator::class)
      ->add(AuthGuard::class);
    
    $route->get('/create', [ReportController::class, 'create'])
      ->add(AuthGuard::class);
  }
}
