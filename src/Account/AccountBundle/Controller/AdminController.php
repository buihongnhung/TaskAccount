<?php
namespace Account\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Account\AccountBundle\Entity\Account;
use Account\AccountBundle\Entity\CoreGroup;
use Account\AccountBundle\Form\Type\RegisterTaskType;
use Account\AccountBundle\Form\Type\LoginTaskType;
use Account\AccountBundle\Form\Type\AdminTaskType;
use Account\AccountBundle\Form\Type\AdminEditTaskType;
use FOS\UserBundle\Model\GroupableInterface;
use Account\AccountBundle\Form\Type\ChangepasswordTaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Account\AccountBundle\Entity\CoreUser;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="adminpage")
     */
    public function adminAction()
    {
        $em = $this->getDoctrine()->getRepository('AccountBundle:CoreUser');

        $secToken = $this->get('security.context')->getToken()->getUser();
        $query = $em -> createQueryBuilder('c')
        ->where('c.id != :userid')
        ->setParameter('userid', $secToken->getId())
        ->getQuery();

        $accounts = $query->getResult();

        return $this->render('AccountBundle:Admin:index.html.twig', array('accounts' => $accounts));
    }

    /**
     * @Route("/addgroup", name="adminaddgroup")
     */
    public function addGroupAction()
    {
        $group = new CoreGroup('ROLE_USER');
        $roles = array('ROLE_BLOGER', 'ROLE_EVENT_MANAGER');
        $group->setRoles($roles);
        $em = $this->getDoctrine()->getManager();
        $em->persist($group);
        $em->flush();
        return $this->redirect('/account');
    }

    /**
     * @Route("/admin/update/{id}", name="adminupdate")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AccountBundle:CoreUser')->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }
        $form = $this->createForm(new AdminEditTaskType(), $user);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em->persist($user);
            $em->flush();
            return $this->redirect('/admin');
        }

        return $this->render('AccountBundle:Admin:create.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/admin/delete/{id}", name="admindelete")
     */
    public function deleteAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AccountBundle:CoreUser')->find($id);

        $roles = array('ROLE_ADMIN');
        $user->setRoles($roles);
        $em->persist($user);
        $em->flush();
        return $this->redirect('/admin');
//        return new Response('delete');
    }
}