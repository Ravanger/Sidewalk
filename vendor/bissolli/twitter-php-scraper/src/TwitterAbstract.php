<?php

namespace Bissolli\TwitterScraper;

use stdClass;

abstract class TwitterAbstract
{
    /**
     * Twitter account handle
     *
     * @var string
     */
    protected $handle;

    /**
     * Parsed HTML from the Twitter account
     *
     * @var \PHPHtmlParser\Dom
     */
    protected $domHtml;

    /**
     * Twitter data profile
     *
     * @var stdClass
     */
    protected $profile;

    /**
     * List of tweets found
     *
     * @var stdClass
     */
    protected $tweets = [];

    /**
     *
     * @return stdClass
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     *
     * @return stdClass
     */
    public function getTweets()
    {
        return $this->tweets;
    }

    /**
     * Return account name
     */
    public function getTwitterAccountName()
    {
        return $this->profile['name'];
    }

    /**
     * Return account avatar URL
     */
    public function getTwitterAvatarURL()
    {
        return $this->profile['avatarUrl'];
    }

    /**
     * Return account website
     */
    public function getTwitterAccountWebsite()
    {
        return $this->profile['website'];
    }

    /**
     * Return account locale
     */
    public function getTwitterAccountLocale()
    {
        return $this->profile['locale'];
    }

    /**
     * Return account bio
     */
    public function getTwitterAccountBio()
    {
        return $this->profile['bio'];
    }

    /**
     * Return account birthday
     */
    public function getTwitterAccountBirthday()
    {
        if (!$this->profile['dateOfBirth']) {
            return;
        }
        return $this->profile['dateOfBirth']->text();
    }

    /**
     * Return number of tweets in array
     */
    public function getTweetsAmount()
    {
        return count($this->tweets);
    }

    /**
     * Return tweet content
     */
    public function getTweetContent($index)
    {
        if (!$this->tweets[$index]['content']) {
            return;
        }
        
        return $this->tweets[$index]['content'];
    }
    
    /**
     *
     * @param $handle
     */
    protected function setHandle($handle)
    {
        $this->handle = $handle;
    }

    /**
     *
     * @param $domHtml
     */
    protected function setDomHtml($domHtml)
    {
        $this->domHtml = $domHtml;
    }

    /**
     *
     * @param $profile
     */
    protected function setProfile($profile)
    {
        $this->profile = $profile;
    }

    /**
     *
     * @param $tweets
     */
    protected function setTweets($tweets)
    {
        $this->tweets = $tweets;
    }

    /**
     * Load profile data from the Twitter account
     *
     * @return void
     */
    abstract protected function extractProfileCard();
}
