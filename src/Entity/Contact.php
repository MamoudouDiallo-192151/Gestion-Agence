<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @var string|null
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 100, minMessage: "Le nom doit contenir au  moins {{ limit }} caractères")]
    //#[Assert\Regex(pattern: "/^[A-Za-z]{3,}$/")]
    private $firstname;

    /**
     * @var string|null
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, minMessage: "Le nom doit contenir au  moins {{ limit }} caractères")]
    private $lastname;

    /**
     * @var string|null
     */
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: "/^[0-9]{8}$/")]
    private $phone;

    /**
     * @var string|null
     */
    #[Assert\Email]
    private $email;


    /**
     * @var string|null
     */
    #[Assert\NotBlank]
    #[Assert\Length(min: 5, minMessage: "Le message doit contenir au  moins {{ limit }} caractères")]
    private $message;

    /**
     * @var Property|null
     */
    private $property;

    /**
     * Get the value of email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @return  self
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set the value of firstname
     *
     * @return  self
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get the value of lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get the value of phone
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of property
     *
     * @return  Property|null
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set the value of property
     *
     * @param  Property|null  $property
     *
     * @return  self
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }
}
