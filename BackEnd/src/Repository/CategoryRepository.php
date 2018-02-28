<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Item;
use Doctrine\ORM\EntityManager;

class CategoryRepository {

    private $em;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public function filterAndCountItems(array $params = null) {

        $categorys = $this->filter($params);

        if ($categorys) {
            foreach ($categorys as $category) {
                $category->setItemsCount(count($this->em->getRepository(Item::class)->findBycategory($category)));
            }
        }

        return $categorys;
    }

    public function findOneAndShowItems(string $slug, int $totalItems): array {

        if ($category = $this->em->getRepository(Category::class)->findOneBySlug($slug)) {
            $items = $this->em->getRepository(Item::class)->findBycategory($category);
        }
        return array('category' => $category, 'items' => $items);
    }

    public function filter(array $params = null) {

        $maxResults = isset($params['maxResults']) ? $params['maxResults'] : 30;
        $col = isset($params['col']) ? $params['col'] : 'id';
        $order = isset($params['order']) ? $params['order'] : 'DESC';

        $query = $this->em->getRepository(Category::class)
                ->createQueryBuilder('p')
                ->orderBy("p.$col", $order)
                ->setMaxResults($maxResults);

        return $query->getQuery()->execute();
    }

    public function deleteCategoryItems($slug): bool {

        if ($category = $this->em->getRepository(Category::class)->findOneBySlug($slug)) {

            if ($items = $this->em->getRepository(Item::class)->findBycategory($category)) {
                foreach ($items as $item) {
                    $this->em->remove($item);
                    $this->em->flush();
                }
            }

            $this->em->remove($category);
            $this->em->flush();

            return true;
        }

        return false;
    }

}
