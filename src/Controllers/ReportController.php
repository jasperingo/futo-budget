<?php
namespace Futo\Budget\Controllers;

use DateTime;
use Futo\Budget\Models\Report;
use Futo\Budget\Models\Transaction;
use Futo\Budget\Models\TransactionType;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class ReportController extends BaseController {
  public function index(Response $response) {
    $reports = $this->entityManager->getRepository(Report::class)->findMany();

    return $this->renderer->render($response, 'reports.php', [
      'reports' => $reports,
    ]);
  }

  public function create(Response $response) {
    return $this->renderer->render($response, 'reports-create.php', [
      'startedAt' => $this->session->getFlash('started_at'),
      'startedAtError' => $this->session->getFlash('startedAtError'),
      'endedAt' => $this->session->getFlash('ended_at'),
      'endedAtError' => $this->session->getFlash('endedAtError'),
    ]);
  }

  public function save(Request $request, Response $response) {
    $data = $request->getParsedBody();

    $transactionRepo = $this->entityManager->getRepository(Transaction::class);

    $report = new Report;
    $report->createdAt = new DateTime;
    $report->endedAt = new DateTime($data['ended_at']);
    $report->startedAt = new DateTime($data['started_at']);
    $report->totalIncome = $transactionRepo->sumAmountByTypeAndCreatedAt(TransactionType::Income, $report->startedAt, $report->endedAt);
    $report->totalExpense = $transactionRepo->sumAmountByTypeAndCreatedAt(TransactionType::Expense, $report->startedAt, $report->endedAt);

    $this->entityManager->getRepository(Report::class)->save($report);

    return $response
      ->withHeader('Location', '/reports')
      ->withStatus(302);
  }
}
