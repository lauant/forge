<?php

namespace Lauant\MCD;

//phpcs:ignore WordPress.Files.Filename.InvalidClassFileName
use Lauant\MCD\Mailchimp;
use Lauant\MCD\Utility as U;
class Controller
{
    private static function get_payload()
    {
        $payload = array();
        if (\array_key_exists('payload', $_REQUEST)) {
            $current_payload = null;
            // convert payload into a query string if it is an array, for consistency.
            if (\is_array($_REQUEST['payload'])) {
                foreach ($_REQUEST['payload'] as $key => $value) {
                }
                $current_payload = \http_build_query($_REQUEST['payload']);
            } else {
                $current_payload = $_REQUEST['payload'];
            }
            // brute forcing against WP's magic quotes. remove slashes that are added
            // by WP automatically.
            $unescaped_single_quote = \str_replace("\\'", "'", $current_payload);
            // phpcs:ignore.
            $unescaped_double_quote = \str_replace('\\"', '"', $unescaped_single_quote);
            \parse_str($unescaped_double_quote, $payload);
        }
        return $payload;
    }
    public static function main()
    {
        $data = array();
        $operation = isset($_REQUEST['operation']) ? \filter_var($_REQUEST['operation'], \FILTER_SANITIZE_STRING) : '';
        $column = isset($_REQUEST['column']) ? \filter_var($_REQUEST['column'], \FILTER_SANITIZE_STRING) : '';
        $model = isset($_REQUEST['model']) ? \filter_var(\ucfirst($_REQUEST['model']), \FILTER_SANITIZE_STRING) : '';
        $payload = self::get_payload();
        $mailchimp = \Lauant\MCD\Mailchimp::get_config();
        $email = '';
        if ($payload) {
            $following = isset($payload['following']) ? \filter_var($payload['following'], \FILTER_SANITIZE_STRING) : '';
            $email = isset($payload['email']) ? \md5(\strtolower(\filter_var($payload['email'], \FILTER_SANITIZE_EMAIL))) : '';
            $member = $mailchimp::get_member($email);
            $tag = isset($payload['tag']) ? \filter_var($payload['tag'], \FILTER_SANITIZE_STRING) : '';
            if ($member) {
                $mailchimp::update_tags($email, $tag, $following);
            } else {
                $email = isset($payload['email']) ? \filter_var($payload['email'], \FILTER_SANITIZE_EMAIL) : '';
                \Lauant\MCD\Utility::log($email);
                $mailchimp::add_member($email, $tag);
            }
        }
        $data = $payload;
        echo \json_encode($data);
        \Lauant\MCD\wp_die();
    }
}
\class_alias('Lauant\\MCD\\Controller', 'Controller', \false);
