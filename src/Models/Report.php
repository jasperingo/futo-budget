<?php
namespace Futo\Budget\Models;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Futo\Budget\Repositories\ReportRepository;

class Report {
	public int $id;

	public float $totalIncome;

	public float $totalExpense;
	
	public DateTime $startedAt;

  public DateTime $endedAt;
	
	public DateTime $createdAt;

  public static function loadMetadata(ClassMetadata $metadata) {
    $builder = new ClassMetadataBuilder($metadata);
    $builder->setTable('reports');
    $builder->setCustomRepositoryClass(ReportRepository::class);
    $builder->createField('id', Types::INTEGER)->makePrimaryKey()->generatedValue()->build();
    $builder->addField('totalIncome', Types::FLOAT);
    $builder->addField('totalExpense', Types::FLOAT);
    $builder->addField('startedAt', Types::DATETIME_MUTABLE);
    $builder->addField('endedAt', Types::DATETIME_MUTABLE);
    $builder->addField('createdAt', Types::DATETIME_MUTABLE);
  }
}
