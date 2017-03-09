<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Post;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostDataFixtures extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $users = $manager->getRepository('AppBundle:User')->findAll();
        $forums = $manager->getRepository('AppBundle:Forum')->findAll();

        foreach ($users as $user) {
            $postCounter = rand(0, 20);
            for ($i = 0; $i < $postCounter; $i++) {
                $post = new Post();
                $post
                    ->setContent(
                        'Lorem ipsum ad his scripta blandit partiendo, eum fastidii accumsan euripidis in,' .
                        'eum liber hendrerit an. Qui ut wisi vocibus suscipiantur, quo dicit ridens inciderint' .
                        'id. Quo mundi lobortis reformidans eu, legimus senserit definiebas an eos. Eu sit' .
                        'tincidunt incorrupte definitionem, vis mutat affert percipit cu, eirmod consectetuer' .
                        'signiferumque eu per. In usu latine equidem dolores. Quo no falli viris intellegam, ut' .
                        'fugit veritus placerat per. Ius id vidit volumus mandamus, vide veritus democritum te' .
                        'nec, ei eos debet libris consulatu. No mei ferri graeco dicunt, ad cum veri accommodare.' .
                        'Sed at malis omnesque delicata, usu et iusto zzril meliore. Dicunt maiorum eloquentiam' .
                        'cum cu, sit summo dolor essent te. Ne quodsi nusquam legendos has, ea dicit voluptua' .
                        'eloquentiam pro, ad sit quas qualisque. Eos vocibus deserunt quaestio ei.' .
                        'Blandit incorrupte quaerendum in quo, nibh impedit id vis, vel no nullam semper audiam.' .
                        'Ei populo graeci consulatu mei, has ea stet modus phaedrum. Inani oblique ne has, duo et' .
                        'veritus detraxit. Tota ludus oratio ea mel, offendit persequeris ei vim. Eos dicat oratio' .
                        'partem ut, id cum ignota senserit intellegat. Sit inani ubique graecis ad, quando graecis' .
                        'liberavisse et cum, dicit option eruditi at duo. Homero salutatus suscipiantur eum id,' .
                        'tamquam voluptaria expetendis ad sed, nobis feugiat similique usu ex.'
                    )
                    ->setAuthor($user)
                    ->setForum($forums[array_rand($forums)]);

                $manager->persist($post);
            }
        }

        $manager->flush();
    }

    public function getOrder()
    {
        return 3;
    }
}
