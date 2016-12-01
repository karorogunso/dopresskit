<?php

namespace Presskit;

class Content
{
    private $title;
    private $foundingDate;
    private $releaseDate;
    private $websiteURL;
    private $websiteName;

    public function setTitle($title)
    {
        $title = (string) $title;

        if ($title !== '') {
            $this->title = $title;
        }
    }

    public function getTitle()
    {
        if ($this->title === null) {
            return false;
        }

        return $this->title;
    }

    public function setFoundingDate($date)
    {
        $date = (string) $date;

        if ($date !== '') {
            $this->foundingDate = $date;
        }
    }

    public function getFoundingDate()
    {
        if ($this->foundingDate === null) {
            return false;
        }

        return $this->foundingDate;
    }

    public function setReleaseDate($date)
    {
        $date = (string) $date;

        if ($date !== '') {
            $this->releaseDate = $date;
        }
    }

    public function getReleaseDate()
    {
        if ($this->releaseDate === null) {
            return false;
        }

        return $this->releaseDate;
    }

    public function setWebsite($website)
    {
        $website = (string) $website;

        if ($website !== '' && filter_var($website, FILTER_VALIDATE_URL) && substr($website, 0, 4) === 'http') {
            $this->websiteURL = $website;

            $host = parse_url($website, PHP_URL_HOST);

            if (substr($host, 0, 4) === 'www.') {
                $host = substr($host, 4);
            }

            $this->websiteName = $host;
        }
    }

    public function getWebsiteURL()
    {
        if ($this->websiteURL === null) {
            return false;
        }

        return $this->websiteURL;
    }
    
    public function getWebsiteName()
    {
        if ($this->websiteName === null) {
            return false;
        }

        return $this->websiteName;
    }
}
