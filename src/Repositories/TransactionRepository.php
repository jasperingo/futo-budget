<?php
namespace Futo\Budget\Repositories;

use Doctrine\ORM\EntityRepository;
use Futo\Budget\Models\Transaction;

class TransactionRepository extends EntityRepository {
  public function save(Transaction $transaction) {
    $this->getEntityManager()->persist($transaction);
    $this->getEntityManager()->flush();
  }

  public function sumAmount() {
    return $this->getEntityManager()
      ->createQuery('SELECT SUM(t.amount) AS balance FROM '. Transaction::class .' t')
      ->getSingleScalarResult();
  }
}
