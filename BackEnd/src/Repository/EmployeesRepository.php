<?php

namespace App\Repository;

use App\Entity\Employees;

use Doctrine\ORM\EntityManager;

class EmployeesRepository {

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

    public function find(array $params = null) {

        $firstName = isset($params['firstName']) ? isset($params['firstName']) : '';
        $limit = isset($params['limit']) ? $params['limit'] : 30 ;
        $firstResult = isset($params['firstResult']) ? $params['firstResult'] : 0;
        $orderBy = isset($params['orderBy']) ? $params['orderBy'] : 'empNo';
        $order = isset($params['order']) ? $params['order'] : 'ASC';

        $query = $this->em->getRepository(Employees::class)
                ->createQueryBuilder('p')
                ->where('p.firstName LIKE :firstName')
                ->setParameter('firstName', "%$firstName%");

        $query->orderBy("p.$orderBy", $order);
        $query->setMaxResults($limit);
        $query->setFirstResult($firstResult);

        return $query->getQuery()->execute();
        
    }

}
