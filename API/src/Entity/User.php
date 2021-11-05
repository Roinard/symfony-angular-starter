<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\Column(type="boolean")
     */
    private $admin;

    /**
     * @ORM\OneToMany(targetEntity=Article::class, mappedBy="author")
     */
    private $articles;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="author")
     */
    private $comments;

    /**
     * @ORM\ManyToMany(targetEntity=Comment::class, mappedBy="downVoters")
     */
    private $downvotedComments;

    /**
     * @ORM\ManyToMany(targetEntity=Comment::class, mappedBy="upVoters")
     */
    private $upvotedComments;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->downvotedComments = new ArrayCollection();
        $this->upvotedComments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getAdmin(): ?bool
    {
        return $this->admin;
    }

    public function setAdmin(bool $admin): self
    {
        $this->admin = $admin;

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->setAuthor($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            // set the owning side to null (unless already changed)
            if ($article->getAuthor() === $this) {
                $article->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuthor($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getAuthor() === $this) {
                $comment->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getDownvotedComments(): Collection
    {
        return $this->downvotedComments;
    }

    public function addDownvotedComment(Comment $downvotedComment): self
    {
        if (!$this->downvotedComments->contains($downvotedComment)) {
            $this->downvotedComments[] = $downvotedComment;
            $downvotedComment->addDownVoter($this);
        }

        return $this;
    }

    public function removeDownvotedComment(Comment $downvotedComment): self
    {
        if ($this->downvotedComments->removeElement($downvotedComment)) {
            $downvotedComment->removeDownVoter($this);
        }

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getUpvotedComments(): Collection
    {
        return $this->upvotedComments;
    }

    public function addUpvotedComment(Comment $upvotedComment): self
    {
        if (!$this->upvotedComments->contains($upvotedComment)) {
            $this->upvotedComments[] = $upvotedComment;
            $upvotedComment->addUpVoter($this);
        }

        return $this;
    }

    public function removeUpvotedComment(Comment $upvotedComment): self
    {
        if ($this->upvotedComments->removeElement($upvotedComment)) {
            $upvotedComment->removeUpVoter($this);
        }

        return $this;
    }
}
