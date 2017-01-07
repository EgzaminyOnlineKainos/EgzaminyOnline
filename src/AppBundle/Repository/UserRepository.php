<?php
namespace AppBundle\Repository;

use AppBundle\Component\Exception\DatabaseErrorException;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityRepository;
use Exception;

class UserRepository extends EntityRepository
{
    public function create(User $user)
    {
        $em = $this->getEntityManager();
        
        $em->beginTransaction();
        try {
            $em->persist($user);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }
    
    public function update(User $user)
    {
        $em = $this->getEntityManager();
        
        $em->beginTransaction();
        try {
            $em->merge($user);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }
    
    public function remove(User $user)
    {
        $em = $this->getEntityManager();
        
        $em->beginTransaction();
        try {
            $em->remove($user);
            $em->flush();
            $em->commit();
        } catch (Exception $e) {
            $em->rollback();
            throw new DatabaseErrorException($e);
        }
    }
}
