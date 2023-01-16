<?php
namespace Futo\Budget\Controllers;

use Slim\Views\PhpRenderer;
use Doctrine\ORM\EntityManager;
use Aura\Session\Segment as SessionSegment;

class BaseController {
  public function __construct(
    protected PhpRenderer $renderer,
    protected EntityManager $entityManager, 
    protected SessionSegment $session,
  ) {}
}
