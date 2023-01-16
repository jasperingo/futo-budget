<?php
namespace Futo\Budget\Controllers;

use \DateTime;
use Futo\Budget\Models\Budget;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class BudgetController extends BaseController {
  public function index(Response $response) {
    $budgets = $this->entityManager->getRepository(Budget::class)->findAll();

    return $this->renderer->render($response, 'budgets.php', [
      'budgets' => $budgets,
    ]);
  }

  public function create(Response $response) {
    return $this->renderer->render($response, 'budgets-create.php', [
      'title' => $this->session->getFlash('title'),
      'titleError' => $this->session->getFlash('titleError'),
      'amount' => $this->session->getFlash('amount'),
      'amountError' => $this->session->getFlash('amountError'),
      'dueAt' => $this->session->getFlash('due_at'),
      'dueAtError' => $this->session->getFlash('dueAtError'),
    ]);
  }

  public function save(Request $request, Response $response) {
    $data = $request->getParsedBody();

    $budget = new Budget;
    $budget->title = $data['title'];
    $budget->amount = $data['amount'];
    $budget->dueAt = new DateTime($data['due_at']);
    $budget->createdAt = new DateTime;

    $this->entityManager->getRepository(Budget::class)->save($budget);

    return $response
      ->withHeader('Location', '/budgets')
      ->withStatus(302);
  }
}
