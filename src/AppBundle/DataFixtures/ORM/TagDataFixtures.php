<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Tag;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->tags() as $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    private function tags()
    {
        return [
            'mesa',
            'comida',
            'agua',
            'boligrafo',
            'telefono',
            'programación',
            'cable',
            'pc',
            'televisión',
            'pelota'
        ];
    }
}
