<?php

namespace Twit\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('TwitAppBundle:Default:index.html.twig');
    }

    public function switchLangAction(Request $request){
        $locale = $request->getLocale();

        if($request->getSession()->get('_locale') == "fr"){
            //$request->setLocale('en');
            $request->getSession()->set('_locale', 'en');
        }
        else{
            //$request->setLocale('fr');
           $request->getSession()->set('_locale', 'fr');
        }

        //die($request->getSession()->get('_locale'));
        return $this->redirect($this->generateUrl('twit_app_homepage'));
    }
}
