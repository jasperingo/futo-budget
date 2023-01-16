<?php
namespace Futo\Budget\Controllers;

use function abs;

use DateTime;
use Futo\Budget\Models\Budget;
use Futo\Budget\Models\Transaction;
use Futo\Budget\Models\TransactionType;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class TransactionController extends BaseController {
  public function index(Response $response) {
    $transactions = $this->entityManager->getRepository(Transaction::class)->findAll();

    return $this->renderer->render($response, 'transactions.php', [
      'transactions' => $transactions,
    ]);
  }

  public function createIncome(Response $response) {
    return $this->renderer->render($response, 'transactions-create-income.php', [
      'amount' => $this->session->getFlash('amount'),
      'amountError' => $this->session->getFlash('amountError'),
      'description' => $this->session->getFlash('description'),
      'descriptionError' => $this->session->getFlash('descriptionError'),
    ]);
  }

  public function createExpense(Response $response) {
    $budgets = $this->entityManager->getRepository(Budget::class)->findAll();

    return $this->renderer->render($response, 'transactions-create-expense.php', [
      'budgets' => $budgets,
      'budget' => $this->session->getFlash('budget'),
      'budgetError' => $this->session->getFlash('budgetError'),
      'amount' => $this->session->getFlash('amount'),
      'amountError' => $this->session->getFlash('amountError'),
      'description' => $this->session->getFlash('description'),
      'descriptionError' => $this->session->getFlash('descriptionError'),
    ]);
  }

  public function save(Request $request, Response $response) {
    $data = $request->getParsedBody();

    $tx = new Transaction;
    $tx->createdAt = new DateTime;
    $tx->description = $data['description'];
    $tx->type = TransactionType::from($data['type']);
    $tx->amount = $tx->type === TransactionType::Expense ? -abs($data['amount']) : $data['amount'];

    if (!empty($data['budget'])) {
      $tx->budget = $this->entityManager->getRepository(Budget::class)->find($data['budget']);
    }

    $this->entityManager->getRepository(Transaction::class)->save($tx);

    return $response
      ->withHeader('Location', '/transactions')
      ->withStatus(302);
  }
}
