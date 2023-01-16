<?php
namespace Futo\Budget\Repositories;

use Doctrine\ORM\EntityRepository;
use Futo\Budget\Models\User;

class UserRepository extends EntityRepository {
  public function save(User $user) {
    $this->getEntityManager()->persist($user);
    $this->getEntityManager()->flush();
  }

  public function findOneByEmail(string $email) {
    return $this->findOneBy(['email' => $email]);
  }

  public function existsByEmail(string $email) {
    $user = $this->findOneBy(['email' => $email]);
    return $user !== null;
  }
}
