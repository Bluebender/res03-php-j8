<?php
require "models/User.php";
require "models/Post.php";
require "models/PostCategory.php";


function loadUser(string $email) : User {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj8",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );
    $query = $db->prepare('SELECT * FROM users WHERE email=:value');
    $parameters = ['value' => $email];
    $query->execute($parameters);
    $loadedUser = $query->fetch(PDO::FETCH_ASSOC);
    
    $loadedUserObject = new User ($loadedUser["first_name"], $loadedUser["last_name"], $loadedUser["email"], $loadedUser["password"]);
    $loadedUserObject->setId($loadedUser["id"]);
    
    return $loadedUserObject;
}

function saveUser(User $user) : User {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj8",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );
    $query = $db->prepare('INSERT INTO users VALUES (null, :value1, :value2, :value3, :value4)');
    $parameters = [
    'value1' => $user->getFirst_name(),
    'value2' => $user->getLast_name(),
    'value3' => $user->getEmail(),
    'value4' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
    ];
    $query->execute($parameters);
    
    return loadUser($user->getEmail());

}

function loadAllPosts() : array {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj8",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );

    $query = $db->prepare('SELECT * FROM posts');
    $query->execute();
    $loadedPosts = $query->fetchAll(PDO::FETCH_ASSOC);

    $loadedPostsObject=[];
    foreach ($loadedPosts as $loadedPost){
        
        // Recupération du user
        $query = $db->prepare('SELECT * FROM users WHERE id=:value');
        $parameters = ['value' => $loadedPost["user_id"]];
        $query->execute($parameters);
        $loadedUser = $query->fetch(PDO::FETCH_ASSOC);
        $loadedUserObject = new User ($loadedUser["first_name"], $loadedUser["last_name"], $loadedUser["email"], $loadedUser["password"]);

        // Recupération de la catégorie
        $query = $db->prepare('SELECT * FROM post_categories WHERE id=:value');
        $parameters = ['value' => $loadedPost["category_id"]];
        $query->execute($parameters);
        $loadedCategory = $query->fetch(PDO::FETCH_ASSOC);
        $loadedCategoryObject = new PostCategory ($loadedCategory["name"], $loadedCategory["description"]);

        $loadedPostObject = new Post ($loadedPost["title"], $loadedPost["content"], $loadedUserObject, $loadedCategoryObject);
        $loadedPostObject->setId($loadedPost["id"]);
        $loadedPostsObject[] = $loadedPostObject;
    }
    
    return $loadedPostsObject;
}

function loadAllCategories() : array {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj8",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );

    $query = $db->prepare('SELECT * FROM post_categories');
    $query->execute();
    $loadedCategories = $query->fetchAll(PDO::FETCH_ASSOC);

    $loadedCategoriesObject=[];
    foreach ($loadedCategories as $loadedCategorie){
        $loadedCategorieObject = new PostCategory ($loadedCategorie["name"], $loadedCategorie["description"]);
        $loadedCategorieObject->setId($loadedCategorie["id"]);
        $loadedCategoriesObject[] = $loadedCategorieObject;
    }

    return $loadedCategoriesObject;
}

function savePost(Post $post) : void {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj8",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );
    
    $query = $db->prepare('INSERT INTO posts VALUES (null, :value1, :value2, :value3, :value4)');
    $parameters = [
    'value1' => $post->getTitle(),
    'value2' => $post->getContent(),
    'value3' => $post->getAuthor()->getId(),
    'value4' => $post->getCategory()->getId()
    ];
    $query->execute($parameters);
    
}



?>