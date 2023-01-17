<?php
namespace Futo\Budget\Validators;

use function time;

use DateTime;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Slim\Psr7\Response;
use Doctrine\ORM\EntityManager;
use Aura\Session\Segment;
use Laminas\Validator\Date;
use Laminas\Validator\NotEmpty;
use Laminas\Validator\ValidatorChain;

class ReportCreateValidator {
  public function __construct(
    private Segment $session, 
    private EntityManager $entityManager
  ) {}

  public function __invoke(Request $request, RequestHandler $handler) {
    $error = false;

    $data = (array) $request->getParsedBody();

    $notEmpty = new NotEmpty;

    $startedAt = new ValidatorChain;
    $startedAt->attach($notEmpty, true);
    $startedAt->attach(new Date, true);

    $startDate = new DateTime($data['started_at']);

    if (!$startedAt->isValid($startDate)) {
      $error = true;
      foreach ($startedAt->getMessages() as $message) {
        $this->session->setFlash('startedAtError', $message);
      }
    }

    $endedAt = new ValidatorChain;
    $endedAt->attach($notEmpty, true);
    $endedAt->attach(new Date, true);

    $endDate = new DateTime($data['ended_at']);

    if (!$endedAt->isValid($endDate)) {
      $error = true;
      foreach ($endedAt->getMessages() as $message) {
        $this->session->setFlash('endedAtError', $message);
      }
    }

    if ($error === false && $startDate->getTimestamp() >= time()) {
      $error = true;
      $this->session->setFlash('startedAtError', 'Field cannot be greater or equal to current time');
    }

    if ($error === false && $endDate->getTimestamp() >= time()) {
      $error = true;
      $this->session->setFlash('endedAtError', 'Field cannot be greater or equal to current time');
    }

    if ($error === false && $endDate->getTimestamp() <= $startDate->getTimestamp()) {
      $error = true;
      $this->session->setFlash('endedAtError', 'Field cannot be greater or equal to start period');
    }
    
    if ($error) {
      $this->session->setFlash('ended_at', $data['ended_at']);
      $this->session->setFlash('started_at', $data['started_at']);
      
      return (new Response)
        ->withHeader('Location', '/reports/create')
        ->withStatus(302);
    }
    
    return $handler->handle($request);
  }
}
