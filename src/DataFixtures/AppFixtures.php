<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AppFixtures extends Fixture
{
    public function __construct(protected PasswordHasherFactoryInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('hello@rapliandras.hu');
        $user->setPassword($this->hasher->getPasswordHasher($user)->hash('asdasdasd'));
        $manager->persist($user);
        $manager->flush();
    }
}
