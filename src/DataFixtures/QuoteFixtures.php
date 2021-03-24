<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Quote;
use Faker;

class QuoteFixtures extends Fixture
{

    const PRIORITY_NONE = 'none';
    const PRIORITY_IMPORTANT = 'important';

    public function load(ObjectManager $manager)
    {
        $faker =  Faker\Factory::create('fr_FR');
        $faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($faker));

        for ($i = 0; $i < 10; $i++) {
            $quote = new Quote;
            $quote->setPosition( random_int(1, 2) === 1 ?  self::PRIORITY_NONE : self::PRIORITY_IMPORTANT );
            $quote->setTitle($faker->catchPhrase)
                ->setContent($faker->markdown);

            $date = new \DateTime('2021-01-01 00:00:00');
            $seconds = random_int(24*60, 100*24*60);
            $date->add(new \DateInterval("PT{$seconds}S"));
            $quote->setCreatedAt($date);

            $manager->persist($quote);
        }

        $manager->flush();
    }
}
