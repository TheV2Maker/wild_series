<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const SERIES = [
        ['title' => 'Les Affranchis', 'synopsis' => 'Dans les années 1950, à Brooklyn, le jeune Henry Hill à l\'occasion de réaliser son rêve : devenir gangster.', 'category' => 'category_Action'],
        ['title' => 'Indiana Jones et le Temple maudit', 'synopsis' => 'Shanghaï, 1935. Le docteur en archéologie et aventurier Indiana Jones', 'category' => 'category_Aventures'],
        ['title' => 'Shrek', 'synopsis' => 'Il était une fois, dans un marais lointain, un ogre au nom de Shrek', 'category' => 'category_Animation'],
        ['title' => 'Le jeu de la Dame', 'synopsis' => 'Une joueuse exceptionnelle dans les années 50 parmi les hommes.', 'category' => 'category_Aventures'],

    ];

    public function load(ObjectManager $manager): void
    {

        foreach (self::SERIES as $serie) {

            $program = new Program();
            $program->setTitle($serie['title']);
            $program->setSynopsis($serie['synopsis']);
            $program->setCategory($this->getReference($serie['category']));
            $manager->persist($program);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class
        ];
    }
}
