<?php

namespace Account\AccountBundle\AccountHandle;

use Doctrine\ORM\EntityManager;
use Account\AccountBundle\AccountHandle\Component\AccountInterface;

class AccountHandle implements AccountInterface
{
    protected $entityManager;

    function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function insertDatabase($object) {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
        return $object;
    }

    public function deleteDatabase($object) {
        $this->entityManager->remove($object);
        $this->entityManager->flush();
        return $object;
    }
}