<?php
namespace Futo\Budget\Controllers;

use Futo\Budget\Models\Budget;
use Futo\Budget\Models\Transaction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class IndexController extends BaseController {
  public function index(Response $response) {
    return $this->renderer->render($response, 'index.php', [
      'email' => $this->session->getFlash('email'),
      'error' => $this->session->getFlash('error'),
    ]);
  }

  public function auth(Request $request, Response $response) {
    $user = $request->getAttribute('user');

    $this->session->set('user', $user);

    return $response
      ->withHeader('Location', "/dashboard")
      ->withStatus(302);
  }

  public function dashboard(Response $response) {
    $budgets = $this->entityManager->getRepository(Budget::class)->findWithLimit();
    $accountBalance = $this->entityManager->getRepository(Transaction::class)->sumAmount();
    $transactions = $this->entityManager->getRepository(Transaction::class)->findWithLimt();

    return $this->renderer->render($response, 'dashboard.php', [
      'budgets' => $budgets,
      'transactions' => $transactions,
      'accountBalance' => $accountBalance,
    ]);
  }

  public function signOut(Response $response) {
    $this->session->set('user', null);
    
    return $response
      ->withHeader('Location', "/")
      ->withStatus(302);
  }
}
