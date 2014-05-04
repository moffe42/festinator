<?php

class PosterService
{
    public function __construct($dbh)
    {
        $this->dbh = $dbh;
    }

    public function isEmailUsed($email)
    {
        $sql = "SELECT COUNT(*) as c FROM `festinator__poster` WHERE email = :email";

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute(array('email' => $email));

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $res[0]['c'] == 1;
    }
}
