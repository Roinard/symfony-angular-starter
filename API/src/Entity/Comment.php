<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */
class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="comments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\Column(type="integer")
     */
    private $up;

    /**
     * @ORM\Column(type="integer")
     */
    private $down;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="downvotedComments")
     */
    private $downVoters;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="upvotedComments")
     */
    private $upVoters;

    public function __construct()
    {
        $this->downVoters = new ArrayCollection();
        $this->upVoters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    public function getUp(): ?int
    {
        return $this->up;
    }

    public function setUp(int $up): self
    {
        $this->up = $up;

        return $this;
    }

    public function getDown(): ?int
    {
        return $this->down;
    }

    public function setDown(int $down): self
    {
        $this->down = $down;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getDownVoters(): Collection
    {
        return $this->downVoters;
    }

    public function addDownVoter(User $downVoter): self
    {
        if (!$this->downVoters->contains($downVoter)) {
            $this->downVoters[] = $downVoter;
        }

        return $this;
    }

    public function removeDownVoter(User $downVoter): self
    {
        $this->downVoters->removeElement($downVoter);

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getUpVoters(): Collection
    {
        return $this->upVoters;
    }

    public function addUpVoter(User $upVoter): self
    {
        if (!$this->upVoters->contains($upVoter)) {
            $this->upVoters[] = $upVoter;
        }

        return $this;
    }

    public function removeUpVoter(User $upVoter): self
    {
        $this->upVoters->removeElement($upVoter);

        return $this;
    }
}
