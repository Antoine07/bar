<?php

namespace App\Entity;

use App\Repository\StatisticRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StatisticRepository::class)
 */
class Statistic
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $score;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $category_id;

    /**
     * @ORM\ManyToOne(targetEntity=Beer::class, inversedBy="statistics")
     */
    private $beer;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="statistics")
     */
    private $client;

    public function __construct()
    {
     
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScore(): ?int
    {
        return $this->score;
    }

    public function setScore(int $score): self
    {
        $this->score = $score;

        return $this;
    }

    public function getCategoryId(): ?string
    {
        return $this->category_id;
    }

    public function setCategoryId(?string $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }


    public function getBeer(): ?Beer
    {
        return $this->beer;
    }

    public function setBeer(?Beer $beer): self
    {
        $this->beer = $beer;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
