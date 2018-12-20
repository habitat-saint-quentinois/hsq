<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Misd\PhoneNumberBundle\Validator\Constraints\PhoneNumber as AssertPhoneNumber;

class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private $type;

    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private $civility;

    /**
     * @var string|null
     */
    private $firstname;

    /**
     * @var string|null
     * @Assert\NotBlank
     */
    private $lastname;

    /**
     * @var string|null
     */
    private $function;

    /**
     * @var string|null
     */
    private $address;

    /**
     * @var int|null
     */
    private $postcode;

    /**
     * @var string|null
     */
    private $city;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @Assert\Email
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank
     * @AssertPhoneNumber(defaultRegion="FR", message="Numéro de téléphone invalide")
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\File(
     *     maxSize = "204800k",
     *     mimeTypes = {"application/pdf", "application/x-pdf", "application/msword", "application/vnd.openxmlformats-officedocument.wordprocessingml.document", "image/jpeg", "image/png"},
     *     mimeTypesMessage = "Votre document doit être un PDF, un document Word ou une image"
     * )
     */
    private $file;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @return null|string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     * @return Contact
     */
    public function setType(?string $type): Contact
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCivility(): ?string
    {
        return $this->civility;
    }

    /**
     * @param null|string $civility
     * @return Contact
     */
    public function setCivility(?string $civility): Contact
    {
        $this->civility = $civility;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param null|string $firstname
     * @return Contact
     */
    public function setFirstname(?string $firstname): Contact
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param null|string $lastname
     * @return Contact
     */
    public function setLastname(?string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFunction(): ?string
    {
        return $this->function;
    }

    /**
     * @param null|string $function
     * @return Contact
     */
    public function setFunction(?string $function): Contact
    {
        $this->function = $function;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param null|string $address
     * @return Contact
     */
    public function setAddress(?string $address): Contact
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getPostcode(): ?int
    {
        return $this->postcode;
    }

    /**
     * @param int|null $postcode
     * @return Contact
     */
    public function setPostcode(?int $postcode): Contact
    {
        $this->postcode = $postcode;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param null|string $city
     * @return Contact
     */
    public function setCity(?string $city): Contact
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param null|string $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param null|string $phone
     * @return Contact
     */
    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * @param null|string $file
     * @return Contact
     */
    public function setFile($file): Contact
    {
        $this->file = $file;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param null|string $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $array = [];
        foreach (get_object_vars($this) as $key => $value) {
            if ($value && $key !== 'file') {
                $key = str_replace(
                    ['type', 'civility', 'firstname', 'lastname', 'function', 'address', 'postcode', 'city', 'email', 'phone', 'message'],
                    ['Vous êtes', 'Civilité', 'Prénom', 'Nom', 'Fonction', 'Adresse', 'Code Postal', 'Ville', 'Email', 'Téléphone', 'Message'],
                    $key
                );
                $array[$key] = $value;
            }
        }
        return $array;
    }
}