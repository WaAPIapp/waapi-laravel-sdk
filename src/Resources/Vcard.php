<?php

namespace WaAPI\WaAPI\Resources;

class Vcard
{
    public function __construct(
        public ?string $waid = null,
        public ?string $iternationalnumber = null,
        public ?string $lastname = null,
        public ?string $firstname = null,
        public ?string $displayname = null,
        public ?string $title = null,
        public ?string $secondname = null,
        public ?string $additionalname = null,
        public ?string $organization = null,
        public ?string $email = null,
        public ?string $street = null,
        public ?string $city = null,
        public ?string $zip = null,
        public ?string $state = null,
        public ?string $country = null,
        public ?string $website = null
    ) {
    }

    public function toArray()
    {
        return (array) $this;
    }

    public function setWaid(?string $waid): void
    {
        $this->waid = $waid;
    }

    public function setIternationalnumber(?string $iternationalnumber): void
    {
        $this->iternationalnumber = $iternationalnumber;
    }

    public function setLastname(?string $lastname): void
    {
        $this->lastname = $lastname;
    }

    public function setFirstname(?string $firstname): void
    {
        $this->firstname = $firstname;
    }

    public function setDisplayname(?string $displayname): void
    {
        $this->displayname = $displayname;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function setSecondname(?string $secondname): void
    {
        $this->secondname = $secondname;
    }

    public function setAdditionalname(?string $additionalname): void
    {
        $this->additionalname = $additionalname;
    }

    public function setOrganization(?string $organization): void
    {
        $this->organization = $organization;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setStreet(?string $street): void
    {
        $this->street = $street;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function setZip(?string $zip): void
    {
        $this->zip = $zip;
    }

    public function setState(?string $state): void
    {
        $this->state = $state;
    }

    public function setCountry(?string $country): void
    {
        $this->country = $country;
    }

    public function setWebsite(?string $website): void
    {
        $this->website = $website;
    }
}
