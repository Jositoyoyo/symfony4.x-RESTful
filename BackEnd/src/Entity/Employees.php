<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Employees
 *
 * @ORM\Table(name="employees", indexes={@ORM\Index(name="fk_employees_department_idx", columns={"department_dept"})})
 * @ORM\Entity
 */
class Employees implements \JsonSerializable {

    /**
     * @var int
     *
     * @ORM\Column(name="emp_no", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $empNo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birth_date", type="date", nullable=false)
     */
    private $birthDate;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=14, nullable=false)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=16, nullable=false)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=1, nullable=false, options={"fixed"=true})
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hire_date", type="date", nullable=false)
     */
    private $hireDate;

    /**
     * @var \Department
     *
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department_dept", referencedColumnName="dept")
     * })
     */
    private $departmentDept;

    /**
     * @return int
     */
    public function getEmpNo()
    {
        return $this->empNo;
    }

    /**
     * @param int $empNo
     */
    public function setEmpNo($empNo)
    {
        $this->empNo = $empNo;
    }

    /**
     * @return \DateTime
     */
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    /**
     * @param \DateTime $birthDate
     */
    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    /**
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    /**
     * @return \DateTime
     */
    public function getHireDate()
    {
        return $this->hireDate;
    }

    /**
     * @param \DateTime $hireDate
     */
    public function setHireDate($hireDate)
    {
        $this->hireDate = $hireDate;
    }

    /**
     * @return \Department
     */
    public function getDepartmentDept() : Department
    {
        return $this->departmentDept;
    }

    /**
     * @param \Department $departmentDept
     */
    public function setDepartmentDept(Department $departmentDept)
    {
        $this->departmentDept = $departmentDept;
    }
    
    
    public function jsonSerialize() {
        return [
            'id' => $this->getEmpNo(),
            'firstName' => $this->getFirstName(),
            'deparment' => $this->getDepartmentDept()
        ];
    }

}
