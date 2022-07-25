<?php

namespace App\Entity;

use App\Repository\PaisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaisRepository::class)]
class Pais
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column()]
    private ?int $id = null;

    #[ORM\Column(length: 255, unique: true)]
    private ?string $name_common = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name_official = null;

    #[ORM\Column(length: 3, nullable: true)]
    private ?string $tld = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $capital = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $region = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subregion = null;

    #[ORM\Column(nullable: true)]
    private ?int $area = null;

    #[ORM\Column(nullable: true)]
    private ?int $population = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $flag = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameCommon(): ?string
    {
        return $this->name_common;
    }

    public function setNameCommon(string $name_common): self
    {
        $this->name_common = $name_common;

        return $this;
    }

    public function getNameOfficial(): ?string
    {
        return $this->name_official;
    }

    public function setNameOfficial(?string $name_official): self
    {
        $this->name_official = $name_official;

        return $this;
    }

    public function getTld(): ?string
    {
        return $this->tld;
    }

    public function setTld(?string $tld): self
    {
        $this->tld = $tld;

        return $this;
    }

    public function getCapital(): ?string
    {
        return $this->capital;
    }

    public function setCapital(?string $capital): self
    {
        $this->capital = $capital;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(?string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getSubregion(): ?string
    {
        return $this->subregion;
    }

    public function setSubregion(?string $subregion): self
    {
        $this->subregion = $subregion;

        return $this;
    }

    public function getArea(): ?int
    {
        return $this->area;
    }

    public function setArea(?int $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getPopulation(): ?int
    {
        return $this->population;
    }

    public function setPopulation(?int $population): self
    {
        $this->population = $population;

        return $this;
    }

    public function getFlag(): ?string
    {
        return $this->flag;
    }

    public function setFlag(?string $flag): self
    {
        $this->flag = $flag;

        return $this;
    }
}
