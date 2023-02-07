<?php

class User {

    // private attribute
    private ?int $id;
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $password;
    private array $posts;

    // public constructor
    public function __construct(string $first_name, string $last_name, string $email, string $password)
    {
        $this->id = null;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->posts = [];
    }

    // public getter
    public function getId() : ?int
    {
        return $this->id;
    }
    public function getFirst_name() : string
    {
        return $this->first_name;
    }
    public function getLast_name() : string
    {
        return $this->last_name;
    }
    public function getEmail() : string
    {
        return $this->email;
    }
    public function getPassword() : string
    {
        return $this->password;
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
    public function setFirst_name(string $first_name) : void
    {
        $this->first_name = $first_name;
    }
    public function setLast_name(string $last_name) : void
    {
        $this->last_name = $last_name;
    }
    public function setEmail(string $email) : void
    {
        $this->email = $email;
    }
    public function setPassword(string $password) : void
    {
        $this->password = $password;
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