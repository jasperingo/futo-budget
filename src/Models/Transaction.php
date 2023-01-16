<?php
namespace Futo\Budget\Models;

use DateTime;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Futo\Budget\Repositories\TransactionRepository;

class Transaction {
	public int $id;

	public TransactionType $type;

	public float $amount;
	
	public string $description;
	
	public DateTime $createdAt;

  public Budget $budget;

  public static function loadMetadata(ClassMetadata $metadata) {
    $builder = new ClassMetadataBuilder($metadata);
    $builder->setTable('transactions');
    $builder->setCustomRepositoryClass(TransactionRepository::class);
    $builder->createField('id', Types::INTEGER)->makePrimaryKey()->generatedValue()->build();
    $builder->addField('type', Types::STRING, ['enumType' => TransactionType::class]);
    $builder->addField('amount', Types::FLOAT);
    $builder->addField('description', Types::STRING);
    $builder->addField('createdAt', Types::DATETIME_MUTABLE);
    $builder->createManyToOne('budget', Budget::class)->inversedBy('transactions')->fetchEager()->addJoinColumn('budgetId', 'id')->build();
  }
}
