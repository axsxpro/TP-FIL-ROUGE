<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Chambre;
use App\Repository\CategorieRepository;
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


    $manager->persist($chambre);
   

            $manager->flush();
        }
   
    }
}
