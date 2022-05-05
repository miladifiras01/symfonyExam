<?php

namespace App\DataFixtures;

use App\Entity\Pfe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PfeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<100;$i++){
            $pfe=new Pfe() ;
            $pfe->setTitre($faker->title) ;
            $pfe->setEtudiant($faker->firstName) ;
//            $pfe->setEntreprise($entreprise) ;
            $manager->persist($pfe);
        }

        $manager->flush();
    }
}