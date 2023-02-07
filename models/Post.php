<?php

class Post {

    // private attribute
    private ?int $id;
    private string $title;
    private string $content;
    private User $author;
    private PostCategory $category;

    // public constructor
    public function __construct(string $title, string $content, User $author, PostCategory $category)
    {
        $this->id = null;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->category = $category;
    }

    // public getter
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getTitle() : string
    {
        return $this->title;
    }
    public function getContent() : string
    {
        return $this->content;
    }
    public function getAuthor() : User
    {
        return $this->author;
    }
    public function getCategory() : PostCategory
    {
        return $this->category;
    }

    // public setter
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }
    public function setContent(string $content) : void
    {
        $this->content = $content;
    }
    public function setAuthor(User $author) : void
    {
        $this->author = $author;
    }
    public function setCategory(PostCategory $category) : void
    {
        $this->category = $category;
    }
}

?>