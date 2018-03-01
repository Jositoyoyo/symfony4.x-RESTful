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

    /**
     * @return string
     */
    public function getDept() {
        return $this->dept;
    }

    /**
     * @param string $dept
     */
    public function setDept($dept) {
        $this->dept = $dept;
    }

    /**
     * @return string
     */
    public function getDeptName() {
        return $this->deptName;
    }

    /**
     * @param string $deptName
     */
    public function setDeptName($deptName) {
        $this->deptName = $deptName;
    }

    public function jsonSerialize() {
        return [
            'dept' => $this->getDept(),
            'deptName' => $this->getDeptName()
        ];
    }

}
