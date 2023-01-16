<?php
namespace Futo\Budget\Routes;

use Futo\Budget\Guards\AuthGuard;
use Futo\Budget\Guards\GuestGuard;
use Futo\Budget\Validators\SignInValidator;
use Slim\Routing\RouteCollectorProxy;
use Futo\Budget\Controllers\IndexController;

class IndexRoute {
  public function __invoke(RouteCollectorProxy $route) {
    $route->get('', [IndexController::class, 'index'])
      ->add(GuestGuard::class);

    $route->post('', [IndexController::class, 'auth'])
      ->add(SignInValidator::class)
      ->add(GuestGuard::class);
    
    $route->get('dashboard', [IndexController::class, 'dashboard'])
      ->add(AuthGuard::class);

    $route->post('sign-out', [IndexController::class, 'signOut'])
      ->add(AuthGuard::class);
  }
}
