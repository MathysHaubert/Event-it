<?php
// src/Entity/ForumMessage.php
namespace App\Entity\Forum\ForumMessage;

use App\Entity\User\User;

class ForumMessage implements \JsonSerializable
{

    private $id;

    private $user;

    private $forum;

    private $like;

    private $message;

    private $resolved;

    private $primary_message;

    // getters and setters

    /**
     * Get the value of id
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of user
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * Set the value of user
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    /**
     * Get the value of forum
     * @return Forum|null
     */
    public function getForum(): ?Forum
    {
        return $this->forum;
    }

    /**
     * Set the value of forum
     * @param Forum $forum
     */
    public function setForum(Forum $forum): void
    {
        $this->forum = $forum;
    }

    /**
     * Get the value of like
     * @return int|null
     */
    public function getLike(): ?int
    {
        return $this->like;
    }

    /**
     * Set the value of like
     * @param int $like
     */
    public function setLike(int $like): void
    {
        $this->like = $like;
    }

    /**
     * Get the value of message
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * Set the value of message
     * @param string $message
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    /**
     * Get the value of resolved
     * @return bool|null
     */
    public function isResolved(): ?bool
    {
        return $this->resolved;
    }

    /**
     * Set the value of resolved
     * @param bool $resolved
     */
    public function setResolved(bool $resolved): void
    {
        $this->resolved = $resolved;
    }

    /**
     * Get the value of primary_message
     * @return bool|null
     */
    public function isPrimaryMessage(): ?bool
    {
        return $this->primary_message;
    }

    /**
     * Set the value of primary_message
     * @param bool $primary_message
     */
    public function setPrimaryMessage(bool $primary_message): void
    {
        $this->primary_message = $primary_message;
    }

    public function jsonSerialize(): mixed
    {
        return [
            'id' => $this->id,
            'user' => $this->user->getId(),
            'forum' => $this->forum->getId(),
            'like' => $this->like,
            'message' => $this->message,
            'resolved' => $this->resolved,
            'primary_message' => $this->primary_message
        ];
    }

    public static function createFromArray(array $params): ForumMessage
    {
        $resource = new self();
        $resource->setMessage($params['message']);
        $resource->setPrimaryMessage($params['primary_message']);
        $resource->setResolved($params['resolved']);
        $resource->setLike($params['like']);
        $resource->setForum($params['forum']);
        $resource->setUser($_SESSION['user']);
        return $resource;
    }
}
