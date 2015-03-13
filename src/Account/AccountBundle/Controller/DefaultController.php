<?php

namespace Account\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Account\AccountBundle\Entity\CoreUser;
use Account\AccountBundle\Form\Type\RegisterTaskType;
use Account\AccountBundle\Form\Type\LoginTaskType;
use Account\AccountBundle\Form\Type\ChangepasswordTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;




class DefaultController extends Controller
{
    /**
     * @Route("/account", name="homepage")
     * @Route("/", name="homepagex")
     */
    public function indexAction()
    {
        $session = new Session();
        $secToken = $this->get('security.context')->getToken()->getUser();

        if($session->get('username') != null) {
            $username = $session->get('username');
            return $this->render('AccountBundle:Default:index.html.twig', array('name' => $username));
        }
        else if ($secToken != 'anon.') {
            if($secToken->getUsernameCanonical() != null) {
                $username = $secToken->getUsernameCanonical();
                if($secToken->getFacebookId() == null)
                    return $this->render('AccountBundle:Default:index.html.twig', array('name' => $username, 'fbid' => $session->get('username') != null));
                return $this->render('AccountBundle:Default:index.html.twig', array('name' => $username));
            }
            else {
                return $this->render('AccountBundle:Default:index.html.twig');
            }
        }
        else {
            return $this->render('AccountBundle:Default:index.html.twig');
        }
    }



    /**
     * @Route("/account/login", name="login")
     */
    public function loginAction(Request $request)
    {

        //use session here
        $session = new Session();
//        $session->start();
//        create account
        $account = new Account();
        $form = $this->createForm(new LoginTaskType(), $account);
        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $username = $form->get('username')->getData();
            $password = $form->get('password')->getData();

            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AccountBundle:CoreUser');
            $user = $repository->findOneBy(array('username'=>$username, 'password'=>$password));
            if($user){
                $session->set('username', $username);
                $session->set('facebook_id', $user->getFacebookId());
                return $this->render('AccountBundle:Default:loginsuccess.html.twig', array('name' => $session->get('username')));
            }
            else
                return $this->redirect('/account');
        }

        return $this->render('AccountBundle:Default:login.html.twig', array('form' => $form->createView(),));

    }


    /**
     * @Route("/account/logout", name="logout")
     */

    public function logoutAction()
    {
        $session = new Session();
        $session->clear();
        $this->get('security.token_storage')->setToken(null);
        $this->get('request')->getSession()->invalidate();

        return $this->render('AccountBundle:Default:index.html.twig');
    }



    /**
     * @Route("/account/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $account = new CoreUser();
        $form = $this->createForm(new RegisterTaskType(), $account);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($account);
            $em->flush();
            return $this->redirect('/account');
        }
        return $this->render('AccountBundle:Default:register.html.twig', array('form' => $form->createView(),));
    }


    /**
     * @Route("/account/changepassword", name="changepassword")
     */
    public function changepasswordAction(Request $request)
    {
        $session = $request->getSession();
        $account = new CoreUser();

//        $form = $this->createForm(new LoginTaskType(), $account);
        $form = $this->createForm(new LoginTaskType(), $account);
        $form->add('new_password', 'text',array('mapped'=>false, 'required'=>true));
        $form->add('confirm_password', 'text',array('mapped'=>false, 'required'=>true));
        if($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $password = $form->get('password')->getData();
            $new_password = $form->get('new_password')->getData();
            $confirm_password = $form->get('confirm_password')->getData();
            if($new_password == $confirm_password){
                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AccountBundle:CoreUser');
                $user = $repository->findOneBy(array('username'=>$session->get('username'), 'password'=>$password));
                if($user){
                    $user->setPassword($new_password);
//                    $session->set('username', $username);
                    $em->persist($user);
                    $em->flush();

                    return $this->redirect('/account');
    //                return $this->render('AccountBundle:Default:loginsuccess.html.twig', array('name' => $session->get('username')));
                }
                else
                    return $this->redirect('/account');
            }
            else
                return $this->redirect('/account');
        }


        return $this->render('AccountBundle:Default:changepassword.html.twig', array('form' => $form->createView()));
    } 

    public function random($length = 30) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    /**
     * @Route("/account/resetpassword", name="resetpassword")
     */
    public function resetpasswordAction(Request $request)
    {
        $session = $request->getSession();
        $_token = $request->query->get('token');
        $_username = $request->query->get('username');

        $account = new CoreUser();

        //first time go to reset page
        if(!isset($_token) || !isset($_username)) {
            $form = $this->createForm(new LoginTaskType(), $account);

            // if user already filled the form
            if($request->getMethod() == 'POST'){
                $form->handleRequest($request);
                $username = $form->get('username')->getData();

                $em = $this->getDoctrine()->getManager();
                $repository = $em->getRepository('AccountBundle:CoreUser');
                $user = $repository->findOneBy(array('username'=>$username));

                // find 1 user by the provided username
                if($user){
                    $mailer = $this->get('mailer');
                    $newToken = $this->random();
                    $currentUrl = $this->getRequest()->getUri();
                    $url = $currentUrl .'?token='. $newToken.'&username='.$user->getUsername();

                    $message = $mailer->createMessage()
                        ->setSubject('You have Completed Registration!')
                        ->setFrom('steambot00001@gmail.com')
                        ->setTo($user->getEmail())
                        ->setBody($url);
                    $mailer->send($message);

                    $user->setConfirmationToken($newToken);
                    $em->persist($user);
                    $em->flush();

                    $session->getFlashBag()->add(
                        'warning',
                        'Visit your email for further instruction'
                    );

                    return $this->redirect('/account');
                }
                //if username is wrong
                else {

                    $session->getFlashBag()->add(
                        'warning',
                        'No such username'
                    );

                    return $this->redirect('/account');
                }
            }
            //if not filled the form
            else {
                return $this->render('AccountBundle:Default:resetpassword.html.twig', array('form' => $form->createView()));
            }
        }
        //if user clicked the link in email
        else {
            $em = $this->getDoctrine()->getManager();
            $repository = $em->getRepository('AccountBundle:CoreUser');
            $user = $repository->findOneBy(array('ConfirmationToken'=>$_token));
            if($user){
                $new_password = $this->random(10);
                $user->setPassword($new_password);
                $em->persist($user);
                $em->flush();

                $session->set('username', $user->getUsername());

                $session->getFlashBag()->add(
                    'warning',
                    'You new password is : '.$new_password
                );
                return $this->redirect('/account');
            }
            else {
                $session->getFlashBag()->add(
                    'warning',
                    'Invalid URL'
                );

                return $this->redirect('/account');
            }
        }
    }

}
