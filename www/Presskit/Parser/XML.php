<?php

namespace Presskit\Parser;

use Presskit\Content;
use SimpleXMLElement;

class XML
{
    private $content;
    private $data;

    public function __construct($file, Content $content)
    {
        $this->content = $content;
        $this->data = new SimpleXMLElement(file_get_contents($file));
    }

    public function parse()
    {
        $this->findTitle();
        $this->findFoundingDate();
        $this->findReleaseDate();
        $this->findWebsite();
        $this->findPressContact();
        $this->findLocation();
        $this->findSocialContacts();
        $this->findAddress();
        $this->findPhone();
        $this->findDescription();

        return $this->content;
    }

    private function findTitle()
    {
        if (count($this->data->title) > 0) {
            $this->content->setTitle($this->data->title);
        }
    }

    private function findFoundingDate()
    {
        if (count($this->data->{'founding-date'}) > 0) {
            $this->content->setFoundingDate($this->data->{'founding-date'});
        }
    }

    private function findReleaseDate()
    {
        if (count($this->data->{'release-date'}) > 0) {
            $this->content->setReleaseDate($this->data->{'release-date'});
        }
    }

    private function findWebsite()
    {
        if (count($this->data->website) > 0) {
            $this->content->setWebsite($this->data->website);
        }
    }

    private function findPressContact()
    {
        if (count($this->data->{'press-contact'}) > 0) {
            $this->content->setPressContact($this->data->{'press-contact'});
        }
    }

    private function findLocation()
    {
        if (count($this->data->{'based-in'}) > 0) {
            $this->content->setLocation($this->data->{'based-in'});
        }
    }

    private function findSocialContacts()
    {
        if (count($this->data->socials) > 0) {
            foreach ($this->data->socials->social as $social) {
                $this->content->addSocialContact($social->name, $social->link);
            }
        }
    }

    private function findAddress()
    {
        if (count($this->data->address) > 0) {
            foreach ($this->data->address->line as $addressLine) {
                $this->content->addAddressLine($addressLine);
            }
        }
    }

    private function findPhone()
    {
        if (count($this->data->phone) > 0) {
            $this->content->setPhone($this->data->phone);
        }
    }

    private function findDescription()
    {
        if (count($this->data->description) > 0) {
            $this->content->setDescription($this->data->description);
        }
    }
}
