<?php

class Poster
{
	private $id = null;
	private $publicId;
	private $headline;
	private $invitation;
	private $email;
	private $created;
	private $updated;

	public function __construct($dbh)
	{
		$this->dbh = $dbh;
	}

    public function getId()
    {
        return $this->id;
    }

    public function getPublicId()
    {
        return $this->publicId;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    public function getHeadline()
    {
        return $this->headline;
    }

    public function setInvitation($invitation)
    {
        $this->invitation = $invitation;
    }

    public function getInvitation()
    {
        return $this->invitation;
    }

	public function save()
	{
		if (is_null($this->id)) {
			$this->insert();
		} else {
			$this->update();
		}
	}

    public function loadById($id = null)
    {
        if (is_null($id)) {
            $id = $this->id;
        }

        $sql = "SELECT * FROM  `festinator__poster` WHERE `id` = :id";
        return $this->load($sql, array('id' => $id));
    }

    public function loadByEmail($email)
    {
        $sql = "SELECT * FROM  `festinator__poster` WHERE `email` = :email";
        return $this->load($sql, array('email' => $email));
    }

    public function loadByPublicId($publicId)
    {
        $sql = "SELECT * FROM  `festinator__poster` WHERE `publicid` = :publicid";
        return $this->load($sql, array('publicid' => $publicId));
    }

    private function load($sql, $params)
    {
        $stmt = $this->dbh->prepare($sql);
        $stmt->execute($params);

        $row = $stmt->fetchAll();

        if (empty($row)) {
            return false;
        }

        $this->id         = $row[0]['id'];
        $this->publicId   = $row[0]['publicid'];
        $this->headline   = $row[0]['headline'];
        $this->invitation = $row[0]['invitation'];
        $this->email      = $row[0]['email'];
        $this->created    = $row[0]['created'];
        $this->updated    = $row[0]['updated'];

        return $this;
    }

	private function insert()
    {
        $sql = "INSERT INTO `festinator__poster` (`id`, `publicid`, `headline`, `invitation`, `email`, `created`, `updated`)
                VALUES (NULL, :publicid, :headline, :invitation, :email, CURRENT_DATE(), CURRENT_TIMESTAMP)";

        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute(array(
            'publicid' => md5($this->email),
            'headline' => $this->headline,
            'invitation' => $this->invitation,
            'email' => $this->email
        ));

        $this->id = $this->dbh->lastInsertId();

        Mailer::mailReceipt($this->email, $this->headline, md5($this->email));
        return $this->loadById();
    }

    private function update()
    {
        $sql = "UPDATE  `festinator__poster`
                SET  `headline` = :headline,
                     `invitation` = :invitation,
                     `email` = :email,
                     `updated` = CURRENT_TIME()
                WHERE  `id` = :id;";

        $stmt = $this->dbh->prepare($sql);
        $res = $stmt->execute(array(
            'headline' => $this->headline,
            'invitation' => $this->invitation,
            'email' => $this->email,
            'id' => $this->id
        ));
        return $this->loadById();
    }
}
