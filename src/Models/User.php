<?php
namespace Futo\Budget\Models;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Mapping\Builder\ClassMetadataBuilder;
use Futo\Budget\Repositories\UserRepository;

class User {
	public int $id;

	public string $firstName;

	public string $lastName;
	
	public string $email;
	
	public string $password;
	
	public function getFullName() {
		return "{$this->firstName} {$this->lastName}";
	}

  public static function loadMetadata(ClassMetadata $metadata) {
    $builder = new ClassMetadataBuilder($metadata);
    $builder->setTable('users');
    $builder->setCustomRepositoryClass(UserRepository::class);
    $builder->createField('id', Types::INTEGER)->makePrimaryKey()->generatedValue()->build();
    $builder->addField('firstName', Types::STRING);
    $builder->addField('lastName', Types::STRING);
    $builder->createField('email', Types::STRING)->unique()->build();
    $builder->addField('password', Types::STRING);
  }
}
