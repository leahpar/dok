<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use function Symfony\Component\String\u;


/**
 * @ORM\Entity(repositoryClass="App\Repository\TestRepository")
 */
class Test
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="geometry", options={"geometry_type"="POINT", "srid"=4326})
     */
    private $point;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPoint()
    {
        return $this->point;
    }

    /**
     * @param mixed $point
     */
    public function setPoint($point): self
    {
        $this->point = $point;
        return $this;
    }

    public function getGPS()
    {
        // 'SRID=4326;POINT(37.4220761 -122.0845187)'
        return u($this->getPoint())->before(')')->after('(')->split(' ');
    }
}
