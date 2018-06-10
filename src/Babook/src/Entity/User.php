<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JsonSerializable;

/**
 * This class represents a registered user.
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Babook\Repository\UserRepository")
 */
class User
{
    // User status constants.
    const STATUS_ACTIVE       = 1; // Active user.
    const STATUS_RETIRED      = 2; // Retired user.

    /**
     * @ORM\Id
     * @ORM\Column(name="id" , type="integer")
     * @ORM\GeneratedValue
     */
    public $id;

    /**
     * @ORM\OneToOne(targetEntity="Profile")
     */
    public $profile;

    /**
     * @ORM\Column(name="email" , unique=true )
     */
    public $email;


    /**
     * @ORM\Column(name="password")
     */
    public $password;

    /**
     * @ORM\Column(name="status" , type="integer")
     */
    public $status;

    /**
     * @ORM\Column(name="date_created" , type="datetime")
     */
    public $dateCreated;

    /**
     * @ORM\Column(name="pwd_reset_token" , nullable=true )
     */
    public $passwordResetToken;

    /**
     * @ORM\Column(name="pwd_reset_token_creation_date" , nullable=true , type="datetime")
     */
    public $passwordResetTokenCreationDate;


    public function __construct()
    {
        $this->status = 0;
        $this->dateCreated = new \DateTime();
    }

 
    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getEmail()
    {
        return $this->email;
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }



    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns possible statuses as array.
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_RETIRED => 'Retired'
        ];
    }

    /**
     * Returns user status as string.
     * @return string
     */
    public function getStatusAsString()
    {
        $list = self::getStatusList();
        if (isset($list[$this->status])) {
            return $list[$this->status];
        }

        return 'Unknown';
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function getPassword()
    {
        return $this->password;
    }


    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }


    public function getDateCreated()
    {
        return $this->dateCreated;
    }


    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }


    public function getResetPasswordToken()
    {
        return $this->passwordResetToken;
    }


    public function setPasswordResetToken($token)
    {
        $this->passwordResetToken = $token;
    }


    public function getPasswordResetTokenCreationDate()
    {
        return $this->passwordResetTokenCreationDate;
    }


    public function setPasswordResetTokenCreationDate($date)
    {
        $this->passwordResetTokenCreationDate = $date;
    }


    public function getProfile()
    {
        return $this->profile;
    }

    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }
}
