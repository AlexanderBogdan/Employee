<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Address;
use AppBundle\Entity\Phone;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Employee;


class LoadEmployeeData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $phone1 = new Phone('+380501234567');
        $phone2 = new Phone('+380671234567');
        $phone3 = new Phone('+380631234567');
        $phone4 = new Phone('+380961234567');

        $address1 = new Address('Kyiv, Ukraine');
        $address2 = new Address('Lviv, Ukraine');
        $address3 = new Address('Odessa, Ukraine');

        $employee = new Employee();
        $employee->setFirstName('Oleksandr');
        $employee->setLastName('Bogdan');
        $employee->setBirthdate(new \DateTime('1988-07-22 00:00:00'));
        $employee->setGender('m');
        $employee->setComment('Some comment');
        $employee->setSalary('7777.77');

        $employee->addPhone($phone1);
        $employee->addPhone($phone2);
        $employee->addPhone($phone3);
        $employee->addPhone($phone4);

        $employee->addAddress($address1);
        $employee->addAddress($address2);
        $employee->addAddress($address3);

        $manager->persist($employee);

        $manager->flush();

    }
}