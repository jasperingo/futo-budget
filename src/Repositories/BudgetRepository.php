<?php
namespace Futo\Budget\Repositories;

use Doctrine\ORM\EntityRepository;
use Futo\Budget\Models\Budget;

class BudgetRepository extends EntityRepository {
  public function save(Budget $budget) {
    $this->getEntityManager()->persist($budget);
    $this->getEntityManager()->flush();
  }

  public function findMany() {
    return $this->getEntityManager()
      ->createQuery('SELECT b FROM '. Budget::class .' b ORDER BY b.createdAt DESC')
      ->getResult();
  }

  public function findWithLimit(int $limit = 5) {
    return $this->getEntityManager()
      ->createQuery('SELECT b FROM '. Budget::class .' b ORDER BY b.createdAt DESC')
      ->setMaxResults($limit)
      ->getResult();
  }
}
