<?php

namespace App\DataFixtures;
use App\Entity\User;
use App\Entity\Reservation;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Chambre;
use App\Entity\Categorie;
use Faker\Factory;
use App\Entity\ReservationChambre;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $categories = [];

        for ($i = 0; $i < 3; $i++) {
            $categorie = new Categorie();
            $categorie->setChambreDoubleSuperieure($faker->word);
            $categorie->setChambreDoubleDeluxe($faker->word);
            $categorie->setSuiteJunior($faker->word);

            $manager->persist($categorie);

            $categories[] = $categorie;
        }

        $chambres = [];

        for ($j = 0; $j <= 10; $j++) {
            $chambre = new Chambre();
            $chambre->setTarif($faker->numberBetween(100, 500));
            $chambre->setSuperficie($faker->numberBetween(16, 50) . ' m²');
            $chambre->setVueSurMer($faker->boolean);
            $chambre->setChainesàLaCarte($faker->boolean);
            $chambre->setClimatisation($faker->boolean);
            $chambre->setTelevisionàEcranPlat($faker->boolean);
            $chambre->setTelephone($faker->boolean);
            $chambre->setChainesSatellite($faker->boolean);
            $chambre->setChainesDuCable($faker->boolean);
            $chambre->setCoffreFort($faker->boolean);
            $chambre->setMaterielDeRepassage($faker->boolean);
            $chambre->setWiFiGratuit($faker->boolean);

            $categorie = $faker->randomElement($categories);

            $chambre->setCategorie($categorie);

            $manager->persist($chambre);

            $chambres[] = $chambre;
        }

        $users = [];

        for ($i = 0; $i < 5; $i++) {
            $user = new User();

            $user->setNom($faker->lastName);
            $user->setPrenom($faker->firstName);
            $user->setEmail($faker->email);
            $user->setAdresse($faker->address);
            $user->setDateDeNaissance($faker->dateTimeBetween('-50 years', '-18 years'));
            $user->setTelephone($faker->phoneNumber);
            $user->setPassword($faker->password);

            $manager->persist($user);

            $users[] = $user;
        }

        for ($j = 0; $j <= 12; $j++) {
            $reservation = new Reservation();

            $dateReservation = $faker->dateTimeBetween('-1 year', 'now');
            $dateSortie = $faker->dateTimeBetween($dateReservation, '+1 month');
            $dateEntrée = $faker->dateTimeBetween('-1 year', $dateSortie);

            $user = $faker->randomElement($users);
            $reservation->setUser($user);

            $reservation->setDateReservation($dateReservation);
            $reservation->setDateEntrée($dateEntrée);
            $reservation->setDateSortie($dateSortie);

            $manager->persist($reservation);

            // Associer des chambres à la réservation en utilisant l'entité pivot
            $chambresReservees = $faker->randomElements($chambres, $faker->numberBetween(1, 5));

            foreach ($chambresReservees as $chambre) {
                $reservationChambre = new ReservationChambre();
                $reservationChambre->setChambre($chambre);
                $reservationChambre->setReservation($reservation);
                $reservationChambre->setDateDeReservation($dateReservation);


                $manager->persist($reservationChambre);
            }
        }

        $manager->flush();
    }
}