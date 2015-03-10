<?php

namespace Twit\UserBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class LoginListener
{
    /**
     * @var string
     */
    protected $user;


    /**
     * @var SecurityContext
     */
    protected $securityContext;

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @param SecurityContext $securityContext
     * @param Router $router The router
     */
    public function __construct(SecurityContext $securityContext, EntityManager $em)
    {
        $this->securityContext = $securityContext;
        $this->em = $em;
        $this->user =  $this->securityContext->getToken();
    }

    public function onLoad()
    {

        if($this->user && $this->user->getUser() != 'anon.') {
            $entity = $this->em->getRepository('QuizUserBundle:User')->find($this->user->getUser()->getId());
            $entity->setIp($_SERVER['REMOTE_ADDR']);
            $entity->setAgent($_SERVER['HTTP_USER_AGENT']);

            $this->em->persist($entity);
            $this->em->flush();
        }
    }
}