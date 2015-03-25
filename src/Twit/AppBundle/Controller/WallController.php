<?php

namespace Twit\AppBundle\Controller;

use Abraham\TwitterOAuth\TwitterOAuth;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Twit\AppBundle\Entity\Wall;
use Twit\AppBundle\Form\WallType;

/**
 * Wall controller.
 *
 */
class WallController extends Controller
{

    /**
     * Lists all Wall entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TwitAppBundle:Wall')->findByUser($this->getUser());

        return $this->render('TwitAppBundle:Wall:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Wall entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Wall();
        $entity->setUser($this->getUser());
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('wall_show', array('id' => $entity->getId())));
        }

        return $this->render('TwitAppBundle:Wall:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Wall entity.
     *
     * @param Wall $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Wall $entity)
    {
        $form = $this->createForm(new WallType(), $entity, array(
            'action' => $this->generateUrl('wall_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Wall entity.
     *
     */
    public function newAction()
    {
        $entity = new Wall();
        $form   = $this->createCreateForm($entity);

        return $this->render('TwitAppBundle:Wall:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Wall entity.
     *
     */
    public function showAction($id)
    {
        $search = "";
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $entity = $em->getRepository('TwitAppBundle:Wall')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wall entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        $client_id = $this->container->getParameter('client_id');
        $client_secret = $this->container->getParameter('client_secret');
        if(!is_null($user->getTwitterId())) {
            $connection = new TwitterOAuth($client_id, $client_secret, $user->getTwitterAccessToken(), $user->getTwitterSecretToken());
            switch($entity->getType()){
                case 1: // mot clee
                    $search = $connection->get("search/tweets", ['q'=> $entity->getValue(), 'count' => 200]);
                    break;
                case 2: // hashtag
                    $search = $connection->get("search/tweets", ['q'=> "#".$entity->getValue(), 'count' => 200]);
                    break;
                case 3: // user
                    $search = $connection->get("statuses/user_timeline", ['screen_name'=> $entity->getValue(), 'count' => 200]);
                    break;
            }
        }

        return $this->render('TwitAppBundle:Wall:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'search'      => $search,
        ));
    }

    /**
     * Displays a form to edit an existing Wall entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TwitAppBundle:Wall')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wall entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('TwitAppBundle:Wall:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Wall entity.
    *
    * @param Wall $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Wall $entity)
    {
        $form = $this->createForm(new WallType(), $entity, array(
            'action' => $this->generateUrl('wall_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Wall entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TwitAppBundle:Wall')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Wall entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('wall_edit', array('id' => $id)));
        }

        return $this->render('TwitAppBundle:Wall:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Wall entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TwitAppBundle:Wall')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Wall entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('wall'));
    }

    /**
     * Creates a form to delete a Wall entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wall_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
