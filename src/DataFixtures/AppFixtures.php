<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {

    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setFirstName('Admin');
        $user->setLastName('Example');
        $user->setEmail('admin@example.com');
        $user->setRoles(['ROLE_ADMIN','ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'Admin@123'
        );
        $user->setPassword($hashedPassword);
        $manager->persist($user);
        $manager->flush();
    }
}
