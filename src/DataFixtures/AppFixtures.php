<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $plainPassword = 'admin';
        $encodedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setPseudo('admin' . $i);
            $user->setPassword($encodedPassword);
            $user->setEmail('admin' . $i . '@gmail.com');
            $user->setRoles(['ROLE_ADMIN']);
            $user->setTotalEpisodesVus(0);
            $manager->persist($user);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
