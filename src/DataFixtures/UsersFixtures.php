<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UsersFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $hasher)
    {
    }

    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $user = (new User());
            // ->addVote()
            $user->setUpdatedAt(\DateTimeImmutable::createFromMutable($faker->DateTime()))
                ->setCreatedAt(\DateTimeImmutable::createFromMutable($faker->DateTime()))
                ->setUsername($faker->userName())
                ->setPassword($this->hasher->hashPassword($user, $faker->password()))
                ->setRoles(['ROLE_USER'])
                ->setEmail($faker->email());
            $manager->persist($user);
            $this->addReference('user' . $i, $user);
        }


        $manager->flush();
    }
}
