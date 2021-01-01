<?php //phpcs:ignore WordPress.Files.Filename.InvalidClassFileName

use MailchimpMarketing as MC;
use MailchimpMarketing\ApiException;
use GuzzleHttp\Exception\RequestException;
use SBA\MCD\Utility as U;

class Mailchimp {
    private static $obj;
    public static $mailchimp;
    private static $apiKey  = '297d91fbde8f2557f1fc3d87fb4802e8-us2';
    private static $server  = 'us2';
    private static $list_id = '77e8d681ff';

    final private function __construct() {
        self::$mailchimp = new MC\ApiClient();
        self::$mailchimp->setConfig(
            array(
                'apiKey' => self::$apiKey,
                'server' => self::$server,
            )
        );
    }

    public static function get_config() {
        if ( ! isset( self::$obj ) ) {
            self::$obj = new Mailchimp();
        }
        return self::$obj;
    }

    public static function get_member( $subscriber_hash ) {
        return self::$mailchimp->lists->getListMember( self::$list_id, $subscriber_hash );
    }

    public static function add_member( $email, $tag ) {
        self::$mailchimp->lists->addListMember(
            self::$list_id,
            array(
                'email_address' => $email,
                'status'        => 'subscribed',
                'tags' => array( $tag ),
            )
        );
    }

    public static function update_tags( $subscriber_hash, $tag, $following ) {
        $active = $following === 'true' ? 'inactive' : 'active';
        
        $response = self::$mailchimp->lists->updateListMemberTags(
            self::$list_id,
            $subscriber_hash,
            array(
                'tags' => array(
                    array(
                        'name'   => $tag,
                        'status' => $active,
                    ),
                ),
            )
        );
    }
}
