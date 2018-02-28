<?php

namespace App\Repository;

use App\Entity\User\User;
use App\Entity\Item;

use Doctrine\ORM\EntityManager;

class UserRepository {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function filterItemsCount(array $params = null): array {

        if ($users = $this->filter($params)) {
            foreach ($users as $user) {
                $user->setItemsCount(count($this->em->getRepository(Item::class)->findByUser($user)));
            }          
        }
        return $users;
    }

    public function filter(array $params = null) {

        $username = isset($params['username']) ? isset($params['username']) : '';
        
        $maxResults = isset($params['maxResults']) ? $params['maxResults'] : 30;
        $firstResult = isset($params['firstResult']) ? $params['firstResult'] : 0;
        
        $rol = isset($params['rol']) ? $params['rol'] : null;
        $col = isset($params['col']) ? $params['col'] : 'id';
        
        $order = isset($params['order']) ? $params['order'] : 'DESC';

        $query = $this->em->getRepository(User::class)
                ->createQueryBuilder('p')
                ->where('p.username LIKE :username')
                ->setParameter('username', "%$username%");
        
        if ($rol) {
            $query->andwhere('p.rol = :rol')
                    ->setParameter('rol', "$rol");
        }

        $query->orderBy("p.$col", $order);
        $query->setMaxResults($maxResults);
        $query->setFirstResult($firstResult);

        return $query->getQuery()->execute();
        
    }

}
