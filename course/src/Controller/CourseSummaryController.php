<?php

namespace Drupal\course\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\course\Entity\Course;
use Symfony\Component\HttpFoundation\Request;

class CourseSummaryController extends ControllerBase{
    public function view(Course $course ){
        return[
            '#theme' => 'item_list',
            '#items' => [
                'Code:' . $course->get('course_code')->value,
                'Name:' . $course->get('course_name')->value,
                'Duration ' . $course->get('course_duration')->value,
                'Active ' . ($course->get('course_is_active')->value ? "Yes" : "No"),
            ],
        ];
    }
}


