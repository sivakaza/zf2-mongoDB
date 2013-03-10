<?php
return array(
    'controllers' => array(
        'invokables' => array(
            'Course\Controller\Course' => 'Course\Controller\CourseController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'course' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/course[/:action][/:id]',
                    'constraints' => array(
                        //action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        //'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Course\Controller\Course',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'course' => __DIR__ . '/../view',
        ),
    ),
);
