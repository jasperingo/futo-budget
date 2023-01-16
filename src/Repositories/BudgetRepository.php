<?php
namespace Futo\Budget\Repositories;

use Doctrine\ORM\EntityRepository;
use Futo\Budget\Models\Budget;

class BudgetRepository extends EntityRepository {
  public function save(Budget $budget) {
    $this->getEntityManager()->persist($budget);
    $this->getEntityManager()->flush();
  }
}
