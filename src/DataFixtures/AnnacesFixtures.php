<?php

namespace App\DataFixtures;


use App\Entity\Annances;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AnnacesFixtures extends Fixture implements  DependentFixtureInterface, FixtureGroupInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');

        for($nbAnnances = 1; $nbAnnances<=500000; $nbAnnances++){
            $user = $this->getReference('user_'. $faker->numberBetween(1, 30));
            $categorie = $this->getReference('categorie_'. $faker->numberBetween(1, 4));

            $annance = new Annances();
            $annance->setUsers($user);
            $annance->setCategories($categorie);
            $annance->setTitle($faker->realText(25));
            $annance->setContent($faker->realText(400));
            $annance->setActive($faker->numberBetween(0, 1));
            $manager->persist($annance);
            $manager->flush();

       }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [

            CategoriesFixtures::class,
            UsersFixtures::class

        ];
    }
    public static function getGroups(): array
    {
        return ['group3'];
    }

}
