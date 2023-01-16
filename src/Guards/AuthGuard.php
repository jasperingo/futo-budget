<?php
namespace Futo\Budget\Guards;

use Slim\Psr7\Response;
use Aura\Session\Segment;
use Psr\Http\Message\RequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class AuthGuard {
  public function __construct(private Segment $session) {}

  public function __invoke(Request $request, RequestHandler $handler) {
    if ($this->session->get('user') === null) {
      return (new Response)
        ->withHeader('Location', "/")
        ->withStatus(302);
    }

    return $handler->handle($request);
  }
}
