<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


use App\Entity\User;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct (UserPasswordHasherInterface $userPasswordHasherInterface) 
    {
        $this->passwordHasher = $userPasswordHasherInterface;
    }

    public function load(ObjectManager $manager)    
    {

        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN']);

        $plainTextPassword = "pass";

        $user->setPassword(
            $this->passwordHasher->HashPassword(
                $user, $plainTextPassword
            )
        );
       
        $manager->persist($user);
        $manager->flush();
  
    }
}
