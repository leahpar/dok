<?php

namespace App\Controller;

use App\Entity\Test;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     */
    public function testpost(EntityManagerInterface $em)
    {
        $data = $em->getRepository(Test::class)->findAll();
        foreach ($data as $d) {
            $em->remove($d);
        }
        $em->flush();


        for ($i=0; $i<15; $i++) {
            $a = new Test();
            $lat = rand(49300, 49500)/1000;
            $lng = rand( 9300, 11600)/10000;
            $a->setName("toto")->setPoint("SRID=4326;POINT($lat $lng)");
            $em->persist($a);
        }

        $em->flush();

        return new Response("<html><head></head><body></body></html>");
    }

    /**
     * @Route("/get", name="get")
     */
    public function testget(EntityManagerInterface $em)
    {

        $data = $em->getRepository(Test::class)->findAll();

        //dump($data);
        //return new Response("<html><head></head><body></body></html>");

        return $this->render("test/index.html.twig", [
            'data' => $data,
        ]);
    }

}

