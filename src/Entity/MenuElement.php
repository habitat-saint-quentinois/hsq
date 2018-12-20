<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MenuElementRepository")
 * @ORM\HasLifecycleCallbacks
 */
class MenuElement
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $level;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $place;

    /**
     * @var \App\Entity\MenuElement
     * @ORM\ManyToOne(targetEntity="App\Entity\MenuElement", inversedBy="children")
     */
    private $parent;

    /**
     * @var \App\Entity\MenuElement[]
     * @ORM\OneToMany(targetEntity="App\Entity\MenuElement", mappedBy="parent")
     * @ORM\OrderBy({"place" = "ASC"})
     */
    private $children;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $label;

    /**
     * @var \App\Entity\Page
     * @ORM\ManyToOne(targetEntity="App\Entity\Page")
     */
    private $page;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private $updatedAt;

    public function __construct()
    {
        $this->children = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function getIsActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param bool $isActive
     * @return \App\Entity\MenuElement
     */
    public function setIsActive(bool $isActive): MenuElement
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int $level
     * @return \App\Entity\MenuElement
     */
    public function setLevel(int $level): MenuElement
    {
        $this->level = $level;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPlace(): ?int
    {
        return $this->place;
    }

    /**
     * @param int $place
     * @return \App\Entity\MenuElement
     */
    public function setPlace(int $place): MenuElement
    {
        $this->place = $place;
        return $this;
    }

    /**
     * @return \App\Entity\MenuElement|null
     */
    public function getParent(): ?MenuElement
    {
        return $this->parent;
    }

    /**
     * @param null|\App\Entity\MenuElement $parent
     * @return MenuElement
     */
    public function setParent(?MenuElement $parent): MenuElement
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActiveChildren(): Collection
    {
        return $this->children->filter(function (MenuElement $child) {
            return $child->getIsActive() === true;
        });
    }

    /**
     * @param \App\Entity\MenuElement $child
     * @return \App\Entity\MenuElement
     */
    public function addChild(MenuElement $child): MenuElement
    {
        if (!$this->children->contains($child)) {
            $this->children[] = $child;
            $child->setParent($this);
        }
        return $this;
    }

    /**
     * @param \App\Entity\MenuElement $child
     * @return \App\Entity\MenuElement
     */
    public function removeChild(MenuElement $child): MenuElement
    {
        if ($this->children->contains($child)) {
            $this->children->removeElement($child);
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return \App\Entity\MenuElement
     */
    public function setLabel(string $label): MenuElement
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @return Page|null
     */
    public function getPage(): ?Page
    {
        return $this->page;
    }

    /**
     * @param Page|null $page
     * @return MenuElement
     */
    public function setPage(?Page $page): MenuElement
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param null|string $link
     * @return \App\Entity\MenuElement
     */
    public function setLink(?string $link): MenuElement
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        if ($this->getLink()) {
            return $this->getLink();
        } else if ($this->getPage()) {
            return '/page/' . $this->getPage()->getSlug();
        }
        return '#';
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $updatedAt
     * @return \App\Entity\MenuElement
     */
    public function setUpdatedAt(\DateTimeInterface $updatedAt): MenuElement
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return \App\Entity\MenuElement
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): MenuElement
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));
        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedLevel()
    {
        if ($this->getParent() !== null) {
            $this->setLevel($this->getParent()->getLevel() + 1);
        } else {
            $this->setLevel(1);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->label;
    }
}
