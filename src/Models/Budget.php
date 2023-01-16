<?php
namespace Futo\Budget\Models;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Futo\Budget\Repositories\BudgetRepository;

class Budget {
	public int $id;

	public string $title;

	public float $amount;
	
	public DateTime $dueAt;
	
	public DateTime $createdAt;

  public static function loadMetadata(ClassMetadata $metadata) {
    $builder = new ClassMetadataBuilder($metadata);
    $builder->setTable('budgets');
    $builder->setCustomRepositoryClass(BudgetRepository::class);
    $builder->createField('id', Types::INTEGER)->makePrimaryKey()->generatedValue()->build();
    $builder->addField('title', Types::STRING);
    $builder->addField('amount', Types::FLOAT);
    $builder->addField('dueAt', Types::DATETIME_MUTABLE);
    $builder->addField('createdAt', Types::DATETIME_MUTABLE);
  }
}
