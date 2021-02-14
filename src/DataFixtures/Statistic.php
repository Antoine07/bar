<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Beer;

class Statistic extends Fixture implements DependentFixtureInterface
{ 
    public function load(ObjectManager $manager)
    {
        $repoBeer = $manager->getRepository(Beer::class);

        //dump($repoBeer->findAll());

        dump('Fixture 2'); 


        // $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AppFixtures::class,
        );
    }
}
