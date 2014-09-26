<?php

namespace Matuz\UserBundle\Controller;

use Matuz\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class UserController
 * @package Matuz\UserBundle\Tests\Controller
 *
 * @Route("/")
 */
class UserController extends Controller{

    /**
     * @Route("/")
     * @Template("MatuzUserBundle:User:update.html.twig")
     */
    public function createAction()
    {
        $user = new User();

        $handler = $this->get('matuz.user.form.handler.user');

        if ($handler->process($user)) {
            return $this->redirect($this->generateUrl('matuz_user_congrats'));
        }

        return [
            'entity' => $user,
            'form' => $handler->getForm()->createView()
        ];
    }

    /**
     * @Route("/congrats", name="matuz_user_congrats")
     * @Template("MatuzUserBundle:User:congrats.html.twig")
     */
    public function congratsAction()
    {
        return [];
    }

} 