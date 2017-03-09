<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Forum;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ForumDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $tags = $manager->getRepository('AppBundle:Tag')->findAll();
        $categories = $manager->getRepository('AppBundle:Category')->findAll();

        for ($i = 0; $i < 10; $i++) {
            $forum = new Forum();

            $forum
                ->setName(sprintf('Foro %d', $i+1))
                ->setDescription('lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam consequat risus vestibulum, maximus elit vitae, hendrerit mauris. Sed finibus, odio non consequat ultricies, ex urna hendrerit mauris, ut posuere diam elit et sem. Morbi eget mauris condimentum, egestas nulla vitae, tempor enim. Fusce semper volutpat elit, eu fringilla tellus tincidunt ut. Suspendisse potenti. Cras ultrices varius arcu ut gravida. Donec auctor mauris in risus blandit, eu consequat felis vestibulum.')
                ->setImage('http://placehold.it/300x300')
                ->setFeatured(false)
                ->setCategory($categories[array_rand($categories)]);

            if (1 === rand(0, 2)) {
                $forum->setFeatured(true);
            }

            $tagsCounter = rand(1, 4);
            foreach ($tags as $key => $tag) {
                if ($key > $tagsCounter) {
                    break;
                }
                $forum->addTag($tag);
            }
            $manager->persist($forum);
        }
        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
    }
}
