<?php

namespace Lauant\MCD;

//phpcs:ignore WordPress.Files.Filename.InvalidClassFileName
use Lauant\MCD\MailchimpMarketing as MC;
use Lauant\MCD\MailchimpMarketing\ApiException;
use Lauant\MCD\GuzzleHttp\Exception\RequestException;
use Lauant\MCD\SBA\MCD\Utility as U;
class Mailchimp
{
    private static $obj;
    public static $mailchimp;
    private static $apiKey = '297d91fbde8f2557f1fc3d87fb4802e8-us2';
    private static $server = 'us2';
    private static $list_id = '77e8d681ff';
    private final function __construct()
    {
        self::$mailchimp = new \Lauant\MCD\MailchimpMarketing\ApiClient();
        self::$mailchimp->setConfig(array('apiKey' => self::$apiKey, 'server' => self::$server));
    }
    public static function get_config()
    {
        if (!isset(self::$obj)) {
            self::$obj = new \Lauant\MCD\Mailchimp();
        }
        return self::$obj;
    }
    public static function get_member($subscriber_hash)
    {
        return self::$mailchimp->lists->getListMember(self::$list_id, $subscriber_hash);
    }
    public static function add_member($email, $tag)
    {
        self::$mailchimp->lists->addListMember(self::$list_id, array('email_address' => $email, 'status' => 'subscribed', 'tags' => array($tag)));
    }
    public static function update_tags($subscriber_hash, $tag, $following)
    {
        $active = $following === 'true' ? 'inactive' : 'active';
        $response = self::$mailchimp->lists->updateListMemberTags(self::$list_id, $subscriber_hash, array('tags' => array(array('name' => $tag, 'status' => $active))));
    }
}
\class_alias('Lauant\\MCD\\Mailchimp', 'Mailchimp', \false);
