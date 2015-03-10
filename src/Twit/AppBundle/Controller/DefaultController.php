<?php

namespace Twit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TwitAppBundle:Default:index.html.twig');
    }
}
