<?php

namespace App\DataFixtures;

use Faker;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Beer;
use App\Entity\Client;
use App\Entity\Category;

use App\Entity\Statistic as Stat;

class Statistic extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        $beers = $manager->getRepository(Beer::class)->findAll();
        $categoryRepo = $manager->getRepository(Category::class);

        for ($i = 0; $i < 20; $i++) {

            $number_beer = random_int(2, count($beers));

            $client = new Client();
            $client->setName($faker->firstName);
            $client->setEmail($faker->email);
            $client->setWeight(random_int(45, 100));
            $client->setNumberBeer($number_beer); // il faut penser à mettre à jour le champ Statistic
            $client->setAge(random_int(20, 80));
            $manager->persist($client);

            foreach (range(0, $number_beer -1) as $id) {
                $stat = new Stat();
                $beer = $beers[$id] ;
                $stat->setBeer($beer);
                $catId = $categoryRepo->findCatbyTermByBeer($beer->getId(), 'normal');
                $stat->setCategoryId(($catId[0])->getId());
                $stat->setClient($client);
                $stat->setScore(random_int(0, 20));
                $manager->persist($stat);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AppFixtures::class,
        );
    }
}
