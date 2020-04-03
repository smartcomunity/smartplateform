<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 29/03/2018
 * Time: 15:45
 */

namespace Limostr\Tools;

use Laminas\Crypt\BlockCipher;
Abstract class CryptDecrypt
{
    public static  $key  = 'FFAADDR125ABCDEFGHIJKLMNOPQRSTUV';//32 caractaire
    public static  $vector= 'ACF456F810ABCDEF';//16 caractaire
    public static  $algo=   "rijndael-128";//MCRYPT_RIJNDAEL_128;//16 caractaire

    private static function hex2bin($h)
    {
        if (!is_string($h)) return null;
        $r='';
        for ($a=0; $a<strlen($h); $a+=2) {
            $r.=chr(hexdec($h{$a}.$h{($a+1)}));
        }
        return $r;
    }

    public static   function getEnc($input)
    {
        //$encrypt = new  \Zend\Filter\Encrypt(array( 'algorithm'=>self::$algo, 'adapter'=>'mcrypt','key' => self::$key,'vector'=>self::$vector));
        $encrypt =  BlockCipher::factory('mcrypt',
            array('algorithm' => self::$algo)
        );
        $encrypt->setKey(self::$key);
        $encrypt->setSalt(self::$vector);
        $encrypted = $encrypt->encrypt($input);
        return bin2hex($encrypted);
    }

    public static function getDec($input)
    {
        $decrypt =  BlockCipher::factory('mcrypt',
            array('algorithm' => self::$algo)
        );
        $decrypt->setKey(self::$key);
        $decrypt->setSalt(self::$vector);

       // $decrypt = new \Zend\Filter\Encrypt(array( 'algorithm'=>self::$algo, 'adapter'=>'mcrypt','key' => self::$key,'vector'=>self::$vector));
        return   $decrypt->decrypt(self::hex2bin($input)) ;
    }
}