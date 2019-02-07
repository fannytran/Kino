<?php

namespace App\Entity;


class Email
{
    private $userEmail;
    private $sendAddress;
    private $subject;
    private $message;

    public function getUserEmail(): ?string
    {
        return $this->userEmail;
    }

    public function setUserEmail(string $userEmail): self
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    public function getSendAddress(): ?string
    {
        return $this->sendAddress;
    }

    public function setSendAddress(string $sendAddress): self
    {
        $this->sendAddress = $sendAddress;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function __toString()
    {
        return "ok";
    }

}
