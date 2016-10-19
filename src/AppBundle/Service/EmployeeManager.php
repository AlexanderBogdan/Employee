<?php

namespace AppBundle\Service;


use AppBundle\Entity\Employee;
use Doctrine\ORM\EntityManager;

class EmployeeManager
{
    private $em;

    /**
     * ExampleManager constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * Create / update employee.
     *
     * @param Employee $employee
     */
    public function save(Employee $employee) {

        foreach ($employee->getPhones() as $phone) {
            if (null === $phone->getPhone()) {
                $employee->removePhone($phone);
            }
        }

        foreach ($employee->getAddresses() as $address) {
            if (null === $address->getAddress()) {
                $employee->removeAddress($address);
            }
        }

        $this->em->persist($employee);
        $this->em->flush();
    }

    /**
     * Remove an employee (mark as removed).
     *
     * @param Employee $employee
     */
    public function remove(Employee $employee) {
        $employee->makeRemoved();
        $this->em->persist($employee);
        $this->em->flush();
    }

    public function findVisible()
    {
        return $this->em->getRepository('AppBundle:Employee')->findBy(['isRemoved' => false]);
    }
}