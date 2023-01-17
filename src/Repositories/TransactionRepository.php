<?php
namespace Futo\Budget\Repositories;

use DateTime;
use Doctrine\ORM\EntityRepository;
use Futo\Budget\Models\Transaction;
use Futo\Budget\Models\TransactionType;

class TransactionRepository extends EntityRepository {
  public function save(Transaction $transaction) {
    $this->getEntityManager()->persist($transaction);
    $this->getEntityManager()->flush();
  }

  public function findMany() {
    return $this->getEntityManager()
      ->createQuery('SELECT t FROM '. Transaction::class .' t ORDER BY t.createdAt DESC')
      ->getResult();
  }

  public function sumAmount() {
    return $this->getEntityManager()
      ->createQuery('SELECT SUM(t.amount) AS balance FROM '. Transaction::class .' t')
      ->getSingleScalarResult();
  }

  public function sumAmountByTypeAndCreatedAt(TransactionType $type, DateTime $startDate, DateTime $endDate) {
    return $this->getEntityManager()
      ->createQuery('SELECT SUM(t.amount) AS balance FROM '. Transaction::class .' t WHERE t.type = :type1 AND t.createdAt >= :startDate2 AND t.createdAt <= :endDate3')
      ->setParameter('type1', $type->name)
      ->setParameter('startDate2', $startDate->format('Y-m-d H:i:s'))
      ->setParameter('endDate3', $endDate->format('Y-m-d H:i:s'))
      ->getSingleScalarResult();
  }
}
