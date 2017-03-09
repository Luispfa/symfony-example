<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategoryDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->categories() as $name) {
            $category = new Category();

            if (is_array($name)) {
                foreach ($name as $key => $el) {
                    $category->setName($key);

                    foreach ($el as $subEl) {
                        $child = new Category();
                        $child->setName($subEl);
                        $child->setParent($category);

                        $manager->persist($child);
                    }
                }
            } else {
                $category->setName($name);
            }
            $manager->persist($category);
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 1;
    }

    private function categories()
    {
        return [
            'general',
            'viajes',
            'entretenimiento',
            'teatro',
            'off-topic',
            ['deportes' => ['fútbol', 'rugby']],
            ['php' => ['symfony', 'laravel']]
        ];
    }
}
