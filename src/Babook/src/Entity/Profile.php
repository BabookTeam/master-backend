<?php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JsonSerializable;

/**
 * This class represents a registered user.
 * @ORM\Table(name="users_profile")
 * @ORM\Entity(repositoryClass="Babook\Repository\UserProfileRepository")
 */
class Profile
{

    /**
     * @ORM\Id
     * @ORM\Column(name="id" , type="integer")
     * @ORM\GeneratedValue
     */
    public $id;

    /**
     * @ORM\Column(name="name" , length=150 )
     */
    public $name;


    /**
     * @ORM\Column(name="surname" , length=150 )
     */
    public $suranme;

    /**
     * @ORM\Column(name="pone" , type="integer" )
     */
    public $phone;

    /**
     * @ORM\Column(name="bio" , type="text")
     */
    public $bio;

    /**
     * @ORM\Column(name="facebook" , nullable=true )
     */
    public $facebook;

    /**
     * @ORM\Column(name="gplus" , nullable=true )
     */
    public $google;

    /**
    * @ORM\OneToOne(targetEntity="User" , inversedBy="profile", fetch="EAGER")
    * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
    */
    public $user;


    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;
    }


    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }


    public function setPhone($phone)
    {
        $this->phone = $phone;
    }


    public function getPhone()
    {
        return $this->phone;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }


    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }


    public function getGoogle()
    {
        return $this->google;
    }


    public function setGoogle($google)
    {
        $this->google = $google;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
    }
}
