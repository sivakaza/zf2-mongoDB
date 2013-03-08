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
                ->getQuery();

        $courses->execute();
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
    }

    public function deleteAction()
    {
    }
}
