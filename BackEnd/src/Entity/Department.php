<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Department
 *
 * @ORM\Table(name="department", uniqueConstraints={@ORM\UniqueConstraint(name="dept_name", columns={"dept_name"}), @ORM\UniqueConstraint(name="dept_UNIQUE", columns={"dept"})})
 * @ORM\Entity
 */
class Department implements \JsonSerializable {

    /**
     * @var string
     *
     * @ORM\Column(name="dept", type="string", length=4, nullable=false, options={"fixed"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $dept;

    /**
     * @var string
     *
     * @ORM\Column(name="dept_name", type="string", length=40, nullable=false)
     */
    private $deptName;
    
     public function jsonSerialize()
    {
        return array(
            'modify' => $this->getModificado(),
            'folder' => $this->getCarpeta(),
            'title' => $this->getTitulo(),
            'slug' => $this->getSlug(),
            'content' => $this->getContenido(),
            'priority' => $this->getPrioridad(),
        );
    }
    
    
}
