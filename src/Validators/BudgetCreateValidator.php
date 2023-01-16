<?php
namespace Futo\Budget\Validators;

use \DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Aura\Session\Segment;
use Laminas\Validator\Date;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\ValidatorChain;

class BudgetCreateValidator {
  public function __construct(
    private Segment $session, 
    private EntityManager $entityManager
  ) {}

  public function __invoke(Request $request, RequestHandler $handler) {
    $error = false;

    $data = (array) $request->getParsedBody();

    $notEmpty = new NotEmpty;

    $title = new ValidatorChain;
    $title->attach($notEmpty);

    if (!$title->isValid($data['title'])) {
      $error = true;
      foreach ($title->getMessages() as $message) {
        $this->session->setFlash('titleError', $message);
      }
    }
    
    $amount = new ValidatorChain;
    $amount->attach($notEmpty, true);
    $amount->attach(new GreaterThan(['min' => 0]));

    if (!$amount->isValid($data['amount'])) {
      $error = true;
      foreach ($amount->getMessages() as $message) {
        $this->session->setFlash('amountError', $message);
      }
    }

    $dueAt = new ValidatorChain;
    $dueAt->attach($notEmpty, true);
    $dueAt->attach(new Date, true);

    if (!$dueAt->isValid(new DateTime($data['due_at']))) {
      $error = true;
      foreach ($dueAt->getMessages() as $message) {
        $this->session->setFlash('dueAtError', $message);
      }
    }
    
    if ($error) {
      $this->session->setFlash('title', $data['title']);
      $this->session->setFlash('amount', $data['amount']);
      $this->session->setFlash('due_at', $data['due_at']);
      
      return (new Response)
        ->withHeader('Location', '/budgets/create')
        ->withStatus(302);
    }
    
    return $handler->handle($request);
  }
}
