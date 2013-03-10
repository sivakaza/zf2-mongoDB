<?php
namespace Course\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Course\Document\Course;
use Course\Form\CourseForm;

class CourseController extends AbstractActionController
{
    public function indexAction()
    {
	$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        $courses = $dm->createQueryBuilder('Course\Document\Course')
                ->limit(20)
                ->getQuery()
		->execute();

        return new ViewModel(array(
           'courses' => $courses,
        ));
    }

    public function addAction()
    {
        $form = new CourseForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();
        if ($request->isPost()) {

            $data = $request->getPost();

            $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
            $course = new Course();
            $course->setName($data['name']);
            $course->setTeacher($data['teacher']);
            $dm->persist($course);
            $dm->flush();

            return $this->redirect()->toRoute('course');
        }
        return array('form' => $form);

    }

    public function editAction()
    {
    $id =  $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('course', array(
                'action' => 'add'
            ));
        }
	//You will get only one course here
	$courses= $this->getCourse($id); 
	foreach($courses as $course){
	$form = new CourseForm();
        $form->bind($course);
        $form->get('submit')->setAttribute('value', 'Edit');
        return array(
            'id' => $id,
            'form' => $form,
        );
	}

	    if ($request->isPost()) {
		error_log("sssssssssssssssssssssssssssssssss");
            $data = $request->getPost();

            $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
            $course = new Course();
            $course->setName($data['name']);
            $course->setTeacher($data['teacher']);
            $dm->persist($course);
            $dm->flush();

            return $this->redirect()->toRoute('course');
        }

    }

    public function deleteAction()
    {
	$id = $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('course');
        }
	$dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
	$qb = $dm->createQueryBuilder('Course\Document\Course');
	$qb->remove()
    	->field('id')->equals(new \MongoId($id))
	->limit(1)
    	->getQuery()
    	->execute();
	return $this->redirect()->toRoute('course');

    }

    public function getCourse($id)
    {
        $dm = $this->getServiceLocator()->get('doctrine.documentmanager.odm_default');
        $qb = $dm->createQueryBuilder('Course\Document\Course')->eagerCursor(true);
	$course= $qb->field('id')->equals(new \MongoId($id))
	->limit(1)
        ->getQuery()
        ->execute();
	return $course;
    }
}
