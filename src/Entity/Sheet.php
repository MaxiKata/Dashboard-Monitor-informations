<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SheetRepository")
 */
class Sheet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $spreadSheetId;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank
     */
    private $rangeSheet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", inversedBy="sheet", cascade={"persist", "remove"})
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSpreadSheetId(): ?string
    {
        return $this->spreadSheetId;
    }

    public function setSpreadSheetId(?string $spreadSheetId): self
    {
        $this->spreadSheetId = $spreadSheetId;

        return $this;
    }

    public function getRangeSheet(): ?string
    {
        return $this->rangeSheet;
    }

    public function setRangeSheet(?string $rangeSheet): self
    {
        $this->rangeSheet = $rangeSheet;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
