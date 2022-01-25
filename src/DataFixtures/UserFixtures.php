<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $userPasswordHasherInterface;
    public function __construct(UserPasswordHasherInterface
    $userPasswordHasherInterface)
    {
        $this->userPasswordHasherInterface =
            $userPasswordHasherInterface;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('medmodiallo19@gmail.com');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setNom('Diallo');
        $user->setPrenom('Mamoudou');
        $user->setPassword(
            $this->userPasswordHasherInterface->hashPassword($user, '192151')
        );
        $manager->persist($user);
        $user2 = new User();
        $user2->setEmail('nouhoumdiallo18@gmail.com');
        $user2->setNom('Diallo');
        $user2->setRoles(['ROLE_USER']);
        $user2->setPrenom('Nouhoum');
        $user2->setPassword(
            $this->userPasswordHasherInterface->hashPassword($user2, '192118')
        );
        $manager->persist($user2);

        $manager->flush();
    }
}
