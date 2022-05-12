<?php

namespace App\DataFixtures;

use App\Entity\Entreprise;
use App\Entity\Pfe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EntrepriseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i=0;$i<20;$i++){
            $entreprise=new Entreprise() ;
            $entreprise->setDesignation($faker->company) ;

            for ($j=0;$j<2;$j++){
                $pfe=new Pfe() ;
                $pfe->setTitre("pfe".$i*2+$j) ;
                $pfe->setEtudiant($faker->firstName) ;
                $pfe->setEntreprise($entreprise) ;
                $manager->persist($pfe);
            }
            $manager->persist($entreprise);
        }
        $manager->flush();
    }
}