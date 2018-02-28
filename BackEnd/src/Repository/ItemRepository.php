<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\User\User;
use App\Entity\Item;
use Doctrine\ORM\EntityManager;

class ItemRepository {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function filter(array $params = null) {

        $title = isset($params['title']) ? isset($params['title']) : '';
        $user = isset($params['user']) ? $params['user'] : null;
        $category = isset($params['category']) ? $params['category'] : null;

        $maxResults = isset($params['maxResults']) ? $params['maxResults'] : 30;

        $col = isset($params['col']) ? $params['col'] : 'id';
        $order = isset($params['order']) ? $params['order'] : 'DESC';

        $query = $this->em->getRepository(Item::class)
                ->createQueryBuilder('p')
                ->where('p.title LIKE :title')
                ->setParameter('title', "%$title%");

        if ($user = $this->em->getRepository(User::class)->findOneByUsername($user) !== null) {
            $query->andwhere('p.user = :user')
                    ->setParameter('user', $user);
        }

        if ($category = $this->em->getRepository(User::class)->findOneByUsername($category)) {
            $query->andwhere('p.category = :category')
                    ->setParameter('category', $category);
        }

        $query->orderBy("p.$col", $order);
        $query->setMaxResults($maxResults);

        return $query->getQuery()->execute();
    }

}
