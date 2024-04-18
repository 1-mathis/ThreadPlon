<?php

namespace App\DataFixtures;

use App\Entity\Vote;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class VotesFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $vote = new Vote();
            $vote
                ->setVote($faker->boolean())
                ->setUserId($this->getReference('user' . $i))
                ->setResponse($this->getReference('response' . $i));
            $manager->persist($vote);
        }


        $manager->flush();
    }

    public function getDependencies()
    {
        return [UsersFixtures::class, ResponsesFixtures::class];
    }
}
