<?php
namespace Account\AccountBundle\Security\Core\User;

use HWI\Bundle\OAuthBundle\OAuth\Response\UserResponseInterface;
use HWI\Bundle\OAuthBundle\Security\Core\User\FOSUBUserProvider as BaseClass;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class FOSUBUserProvider extends BaseClass
{

    /**
     * {@inheritDoc}
     */
    public function connect(UserInterface $user, UserResponseInterface $response)
    { 
        $username = $response->getUsername();
        $name = $response->getNickname();
        $email = $response->getEmail();
        $accessToken = $response->getAccessToken();

        // // // // we "disconnect" previously connected users
        if (null !== $newUser = $this->userManager->findUserBy(array('facebook_id' => $username))) {
        //     // $newUser = $this->userManager->createUser();
            // $newUser->setEmailCanonical($email);
            $newUser->setEmail($email);
            $newUser->setPassword($accessToken);
            $newUser->setFacebookId($username);
            $newUser->setUsernameCanonical($name);
            $newUser->setConfirmationToken($accessToken);
            $newUser->setEnabled(1);
            $this->userManager->updateUser($newUser);
        }
        else {
            $session = new Session();
            var_dump($session->get('username'));
            $newUser = $this->userManager->findUserBy(array('email' => $email));
            // $newUser = $this->userManager->createUser();
            if($newUser != null) {
                // $newUser->setEmailCanonical($email);
                $newUser->setFacebookId($username);
                $newUser->setConfirmationToken($accessToken);
                $newUser->setEnabled(1);
                $this->userManager->updateUser($newUser);
            }
            else {
                $newUser = $this->userManager->createUser();
                // $newUser->setEmailCanonical($email);
                $newUser->setEmail($email);
                $newUser->setPassword($accessToken);
                $newUser->setFacebookId($username);
                $newUser->setUsername($name);
                $newUser->setConfirmationToken($accessToken);
                $newUser->setEnabled(1);
                $this->userManager->updateUser($newUser);
            }
        }
        echo '<a href="/account">Homepage</a>';
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByOAuthUserResponse(UserResponseInterface $response)
    {
        echo 'zxczxczxczx';
        // echo $response->getNickname();

        $username = $response->getUsername();
        $user = $this->userManager->findUserBy(array($this->getProperty($response) => $username));
        //when the user is registrating
        if (null === $user) {
            $service = $response->getResourceOwner()->getName();
            $setter = 'set'.ucfirst($service);
            $setter_id = $setter.'Id';
            $setter_token = $setter.'AccessToken';
            // create new user here
            $user = $this->userManager->createUser();
            $user->$setter_id($username);
            // $user->$setter_token($response->getAccessToken());
            //I have set all requested data with the user's username
            //modify here with relevant data
            $user->setUsername($username);
            $user->setEmail($username);
            $user->setPassword($username);
            $user->setEnabled(true);
            $this->userManager->updateUser($user);
            return $user;
        }

        //if user exists - go with the HWIOAuth way
        $user = parent::loadUserByOAuthUserResponse($response);

        $serviceName = $response->getResourceOwner()->getName();
        $setter = 'set' . ucfirst($serviceName) . 'AccessToken';

        //update access token
        // $user->$setter($response->getAccessToken());

        return $user;
    }

}