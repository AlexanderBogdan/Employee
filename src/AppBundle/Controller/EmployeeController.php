<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Address;
use AppBundle\Entity\Phone;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Employee;

/**
 * Employee controller.
 *
 * @Route("/employee")
 */
class EmployeeController extends Controller
{
    /**
     * Lists all Employee entities.
     *
     * @Route("/", name="employee_index")
     * @Method("GET")
     * @Security("has_role('ROLE_WORKER')")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $this->get('app.employee.manager')->findVisible();

        return $this->render('employee/index.html.twig',
            array(
                'employees' => $employees,
            ));
    }

    /**
     * Creates a new Employee entity.
     *
     * @Route("/new", name="employee_new")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_MANAGER')")
     */
    public function newAction(Request $request)
    {
        $employee = new Employee();
        $employee->addPhone(new Phone());
        $employee->addAddress(new Address());

        $form = $this->createForm('AppBundle\Form\EmployeeType', $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.employee.manager')->save($employee);

            return $this->redirectToRoute('employee_show', array('id' => $employee->getId()));
        }

        return $this->render('employee/new.html.twig',
            array(
                'employee' => $employee,
                'form' => $form->createView(),
            ));
    }

    /**
     * Finds and displays a Employee entity.
     *
     * @Route("/{id}", name="employee_show")
     * @Method("GET")
     * @Security("has_role('ROLE_WORKER')")
     */
    public function showAction(Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('employee/show.html.twig',
            array(
                'employee' => $employee,
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Displays a form to edit an existing Employee entity.
     *
     * @Route("/{id}/edit", name="employee_edit")
     * @Method({"GET", "POST"})
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Employee $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('AppBundle\Form\EmployeeType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->get('app.employee.manager')->save($employee);

            return $this->redirectToRoute('employee_edit', array('id' => $employee->getId()));
        }

        return $this->render('employee/edit.html.twig',
            array(
                'employee' => $employee,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
    }

    /**
     * Deletes a Employee entity.
     *
     * @Route("/{id}", name="employee_delete")
     * @Method("DELETE")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Employee $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.employee.manager')->remove($employee);
        }

        return $this->redirectToRoute('employee_index');
    }

    /**
     * Creates a form to delete a Employee entity.
     *
     * @param Employee $employee The Employee entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employee $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employee_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
}
