<?php
namespace Futo\Budget\Repositories;

use Doctrine\ORM\EntityRepository;
use Futo\Budget\Models\Report;

class ReportRepository extends EntityRepository {
  public function save(Report $report) {
    $this->getEntityManager()->persist($report);
    $this->getEntityManager()->flush();
  }

  public function findMany() {
    return $this->getEntityManager()
      ->createQuery('SELECT r FROM '. Report::class .' r ORDER BY r.createdAt DESC')
      ->getResult();
  }
}
