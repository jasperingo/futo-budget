<?php
namespace Futo\Budget\Models;

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
    $builder->createField('id', 'integer')->makePrimaryKey()->generatedValue()->build();
    $builder->addField('firstName', 'string');
    $builder->addField('lastName', 'string');
    $builder->createField('email', 'string')->unique()->build();
    $builder->addField('password', 'string');
  }
}
