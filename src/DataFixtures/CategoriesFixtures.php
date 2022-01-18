<?php

namespace App\DataFixtures;


use App\Entity\Categories;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CategoriesFixtures extends Fixture implements  FixtureGroupInterface

{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $categories = [
            1 => [
                'name' => 'Vehecules'
            ],
            2 => [
                'name' => 'Sport'
            ],
            3 => [
                'name' => 'Immobilier'
            ],
            4 => [
                'name' => 'outils'
            ],
        ];
        foreach ($categories as $key => $value){
            $categorie = new Categories();
            $categorie->setName($value['name']);
            $manager->persist($categorie);

            //Enregistrer la categorie dans une reference
            $this->addReference('categorie_' . $key, $categorie);

        }

        $manager->flush();
    }
    public static function getGroups(): array
    {
        return ['group2'];
    }
}