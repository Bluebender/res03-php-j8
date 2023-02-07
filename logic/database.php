<?php
require "models/User.php";


function loadUser(string $email) : ?User {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj7",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );
    $query = $db->prepare('SELECT * FROM users WHERE email=:value');
    $parameters = ['value' => $email];
    $query->execute($parameters);
    $loadedUser = $query->fetch(PDO::FETCH_ASSOC);
    
    $loadedUserObject = new User ($loadedUser["firstName"], $loadedUser["lastName"], $loadedUser["email"], $loadedUser["password"]);
    $loadedUserObject->setId($loadedUser["id"]);
    
    return $loadedUserObject;
}

function saveUser(User $user) : User {
    $db = new PDO(
        "mysql:host=db.3wa.io;port=3306;dbname=vincentollivier_phpj7",
        "vincentollivier",
        "98f74e8350a6f9da22f312f5162d2994"
    );
    $query = $db->prepare('INSERT INTO users VALUES (null, :value1, :value2, :value3, :value4)');
    $parameters = [
    'value1' => $user->getFirstName(),
    'value2' => $user->getLastName(),
    'value3' => $user->getEmail(),
    'value4' => password_hash($user->getPassword(), PASSWORD_DEFAULT)
    ];
    $query->execute($parameters);
    
    return loadUser($user->getEmail());

}



?>