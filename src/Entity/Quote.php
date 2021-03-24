<?php

namespace App\Entity;

use App\Repository\QuoteRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=QuoteRepository::class)
 */
class Quote
{
    const PRIORITY_NONE = 'none';
    const PRIORITY_IMPORTANT = 'important';

    public function __construct(){
        // une constante self car comme les variables elles ne dépendent pas de l'instance de la classe
        $this->setPosition(self::PRIORITY_NONE);
        $this->setCreatedAt(new \DateTime('now'));
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank(message="Attention ce champ ne peut pas être vide")
     * @Assert\Length(
     *  min=5,
     *  max=60,
     *  minMessage = "Votre titre est trop court {{ limit }} min",
     *  maxMessage = "Votre titre est trop long {{ limit }} max"
     * )
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Attention ce champ ne peut pas être vide")
     */
    private $content;

    // le choice risque de ne pas marcher car vous avez une vérification au niveau de l'hydratation des données avec l'ENUM voir 
    // la méthode setPosition qui lance une exception courcircuite la validation
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     * @Assert\Choice({"important", "none"}, message="attention votre choix n'est pas acceptable")
     */
    private $position;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(?string $position): self
    {
        // Avec Doctrine on pas ENUM une manière code pour simuler pour les SGDB
        if (!in_array($position, array(self::PRIORITY_NONE, self::PRIORITY_IMPORTANT))) {
           throw new \InvalidArgumentException("Invalid status");
        }

        $this->position = $position;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(?\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }
}
