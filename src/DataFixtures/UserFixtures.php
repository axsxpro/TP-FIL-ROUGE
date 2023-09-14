<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();

        $users = [];

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail($faker->unique()->email);
            $user->setPassword(password_hash($faker->password, PASSWORD_BCRYPT));
            $user->setRoles(['ROLE_USER']);
            $user->setNom($faker->lastName);
            $user->setPrenom($faker->firstName);
            $user->setAdresse($faker->address);
            $user->setTelephone($faker->phoneNumber);
            $user->setDateDeNaissance($faker->dateTimeBetween('-40 years', '-18 years'));

            $manager->persist($user);
        }

        $manager->flush();
    }
}
