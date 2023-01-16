<?php
namespace Futo\Budget\Validators;

use function strtolower;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Aura\Session\Segment;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\GreaterThan;
use Laminas\Validator\ValidatorChain;
use Laminas\Validator\AbstractValidator;
use Futo\Budget\Models\Transaction;
use Futo\Budget\Models\TransactionType;

class TransactionCreateValidator {
  public function __construct(
    private Segment $session, 
    private EntityManager $entityManager
  ) {}

  public function __invoke(Request $request, RequestHandler $handler) {
    $error = false;

    $data = (array) $request->getParsedBody();

    $notEmpty = new NotEmpty;

    $amount = new ValidatorChain;
    $amount->attach($notEmpty, true);
    $amount->attach(new GreaterThan(['min' => 0]));

    if ($data['type'] === TransactionType::Expense->value) {
      $amount->attach((new ExpenseAmountValidator)->setEntityManager($this->entityManager));
    }

    if (!$amount->isValid($data['amount'])) {
      $error = true;
      foreach ($amount->getMessages() as $message) {
        $this->session->setFlash('amountError', $message);
      }
    }

    $description = new ValidatorChain;
    $description->attach($notEmpty);

    if (!$description->isValid($data['description'])) {
      $error = true;
      foreach ($description->getMessages() as $message) {
        $this->session->setFlash('descriptionError', $message);
      }
    }
    
    if ($error) {
      $this->session->setFlash('budget', $data['budget']);
      $this->session->setFlash('amount', $data['amount']);
      $this->session->setFlash('description', $data['description']);

      $to = strtolower($data['type']);
      
      return (new Response)
        ->withHeader('Location', "/transactions/create/{$to}")
        ->withStatus(302);
    }
    
    return $handler->handle($request);
  }
}

class ExpenseAmountValidator extends AbstractValidator {
  const ERROR = 'error';

  private EntityManager $entityManager;

  protected $messageTemplates = [
    self::ERROR => "%value% is more than account balance",
  ];

  public function setEntityManager(EntityManager $entityManager) {
    $this->entityManager = $entityManager;
    return $this;
  }

	public function isValid($value) {
    $this->setValue($value);

    if ($value > $this->entityManager->getRepository(Transaction::class)->sumAmount()) {
      $this->error(self::ERROR);
      return false;
    }

    return true;
	}
}
