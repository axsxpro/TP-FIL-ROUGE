<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Chambre;
use App\Entity\Reservation;
use App\Entity\User;
use Faker\Factory;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $categories = []; 

for ($i = 0; $i < 5; $i++) {
    $categorie = new Categorie();
    $categorie->setChambreDoubleSuperieure($faker->word);
    $categorie->setChambreDoubleDeluxe($faker->word); 
    $categorie->setSuiteJunior($faker->word); 

    $manager->persist($categorie);


    $categories[] = $categorie;
}



        $chambres  = [];

for ($j = 1; $j <= 10; $j++) {
    $chambre = new Chambre();
    $chambre->setChainesSatellite($faker->boolean(true, false));
    $chambre->setTelephone($faker->boolean(true, false));
    $chambre->setTelevisionàEcranPlat($faker->boolean(true, false));
    $chambre->setTarif($faker->numberBetween(50, 200));
    $chambre->setSuperficie($faker->numberBetween(40, 100));
    $chambre->setVueSurMer($faker->boolean(true, false));
    $chambre->setChainesàLaCarte($faker->boolean(true,false));
    $chambre->setClimatisation($faker->boolean(true,false));
    $chambre->setChainesDuCable($faker->boolean(true,false));
    $chambre->setCoffreFort($faker->boolean(true,false));
    $chambre->setMaterielDeRepassage($faker->boolean(true,false));
    $chambre->setWifiGratuit($faker->boolean(true,false));
    $categorie = $faker->randomElement($categories); 

    $chambre->setCategorie($categorie);

    $manager->persist($chambre);


$users = [];

for ($i = 0; $i < 10; $i++) {
    $user = new User();

    $user->setNom($faker->lastName);
    $user->setPrenom($faker->firstName);
    $user->setEmail($faker->email);
    $user->setAdresse($faker->word());
    $user->setDateDeNaissance($faker->dateTime());
    $user->setTelephone($faker->phoneNumber);
    $user->setPassword($faker->password);

    $manager->persist($user);

    $users[] = $user;
}

//Proleme date anterieur

for ($j = 0; $j <= 10; $j++) {
    $reservation = new Reservation();

    $dateReservation = $faker->dateTimeBetween();
    $dateEntrée = $faker->dateTimeBetween($dateReservation, '+1 month');
    $dateSortie = $faker->dateTimeBetween($dateEntrée, '+1 week');

    $reservation->setDateReservation($dateReservation);
    $reservation->setDateEntree($dateEntrée);
    $reservation->setDateSortie($dateSortie);

     // Associer la réservation à un utilisateur aléatoir

    $userIndex = array_rand($users);
    $user = $users[$userIndex];
    $reservation->setUser($user);

    $manager->persist($reservation);
}


$manager->flush();




}

 
   

        }
   
    }

