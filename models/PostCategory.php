<?php

class PostCategory {

    // private attribute
    private ?int $id;
    private string $name;
    private string $description;
    private array $posts;

    // public constructor
    public function __construct(string $name, string $description)
    {
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->posts = [];
    }

    // public getter
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getName() : string
    {
        return $this->name;
    }
    public function getDescription() : string
    {
        return $this->description;
    }
    public function getPosts() : array
    {
        return $this->post;
    }

    // public setter
    public function setId(int $id) : void
    {
        $this->id = $id;
    }
    public function setName(string $name) : void
    {
        $this->name = $name;
    }
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }
    public function setPosts(array $posts) : void
    {
        $this->posts = $posts;
    }
    
    // Les methodes
    public function addPost(Post $post) : array
    {
        $this->posts[] = $post;
        return $this->posts;
    }
    public function removePost(Post $post) : array
    {
        for ($i=0; $i<count($this->posts); $i++){
            if ($this->posts[$i]===$post){
                unset($this->posts[$i]);
                return $this->posts;
            }
        }
    }
}

?>