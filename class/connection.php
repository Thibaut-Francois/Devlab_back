<?php


class Connection{

    public PDO $pdo;

    public function __construct()
    {
        $this->pdo = new PDO('mysql:dbname=devlab_back;host=127.0.0.1','root','');
    }

    public function insert(User $user)
    {
        $query = 'INSERT INTO user (email, password, pseudo)
                VALUES (:email, :password, :pseudo)';

        $statement= $this->pdo->prepare($query);

        return $statement->execute([
            'email'=>$user->email,
            'password'=>md5($user->password. 'UN_PETIT_GRAIN2SABLE'),
            'pseudo'=>$user->pseudo,

        ]);
    }

    public function getAll():array{
        $sth = $this->pdo->prepare("SELECT * FROM user");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);


    }
/*
    public function delete(int $id):bool{
        $query = 'DELETE FROM user
                WHERE id=:id';

        $sth=$this->pdo->prepare($query);

        return $sth->execute([
            'id'=>$id,
        ]);
    }*/

    public function isExisting(string $pw, string $email):array{
        $pass = md5($pw. 'UN_PETIT_GRAIN2SABLE');

        $sth = $this->pdo->prepare('SELECT * FROM user
                                        WHERE email=:email AND password=:pass');
        $sth->execute(['email'=>$email, 'pass'=>$pass]);

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function antiDoppelganger($new):bool{

        $sth = $this->pdo->prepare("SELECT email FROM user
                                        WHERE email=:new");
        $sth->execute(['new'=>$new]);
        $oui=$sth->fetchAll(PDO::FETCH_ASSOC);
        if(empty($oui)){
            $isValid = true;
        }else{
            $isValid = false;
        }

        return $isValid;
    }



    public function getMyAlbums($id):array{
        $sth = $this->pdo->prepare("SELECT album.`name` FROM album
                                LEFT JOIN user_album ON album.id = user_album.album_id
                                LEFT JOIN user ON user.id = user_album.user_id
                                WHERE :id = user_album.user_id;");
        $sth->execute(['id'=>$id]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getPublicAlbum():array{
        $sth = $this->pdo->prepare("SELECT * FROM album
                                          WHERE isPublic = 1");
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


    public function insertAlbum(Album $album):array{
        $query = 'INSERT INTO album (name, isPublic, `like`)
                VALUES (:name, :public, :jaime)';

        $statement= $this->pdo->prepare($query);

        $statement->execute([
            'name'=>$album->name,
            'public'=>$album->public ? 1 : 0,
            'jaime'=>0,
        ]);

        $sth = $this->pdo->prepare("SELECT album.id FROM album
                                    WHERE album.`name` = :name
                                    ORDER BY album.id DESC
                                    LIMIT 1;");
        $sth->execute([
            'name'=>$album->name,
        ]);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    public function linkUserAlbum($albumId, $userId){
        $query = 'INSERT INTO user_album (`user_id`, `album_id`)
                VALUES (:userId, :albumId)';

        $statement= $this->pdo->prepare($query);

        return $statement->execute([
            'userId'=>$userId,
            'albumId'=>$albumId,
        ]);
    }
}