<?php
/**
 * Created by PhpStorm.
 * User: o.limam
 * Date: 21/03/2018
 * Time: 11:05
 */

namespace Limostr\Tools;
use Laminas\Mail;
use Laminas\Mime\Message as MimeMessage;
use Laminas\Mime\Part as MimePart;
 
class MailSender
{

    private $Content;
    private $From;
    private $To;
    private $Subject;
    private $Cc;
    private $Bcc;
    private $NameFrom;

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->Content;
    }

    /**
     * @param mixed $Content
     */
    public function setContent($Content)
    {
        $this->Content = $Content;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->From;
    }

    /**
     * @param mixed $From
     */
    public function setFrom($From)
    {
        $this->From = $From;
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->To;
    }

    /**
     * @param mixed $To
     */
    public function setTo($To)
    {
        $this->To = $To;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->Subject;
    }

    /**
     * @param mixed $Subject
     */
    public function setSubject($Subject)
    {
        $this->Subject = $Subject;
    }

    /**
     * @return mixed
     */
    public function getCc()
    {
        return $this->Cc;
    }

    /**
     * @param mixed $Cc
     */
    public function setCc($Cc)
    {
        $this->Cc = $Cc;
    }

    /**
     * @return mixed
     */
    public function getBcc()
    {
        return $this->Bcc;
    }

    /**
     * @param mixed $Bcc
     */
    public function setBcc($Bcc)
    {
        $this->Bcc = $Bcc;
    }

    /**
     * @return mixed
     */
    public function getNameFrom()
    {
        return $this->NameFrom;
    }

    /**
     * @param mixed $NameFrom
     */
    public function setNameFrom($NameFrom)
    {
        $this->NameFrom = $NameFrom;
    }


    public function sendMail($content=""){

       // $socket = fsockopen("ssl://smtp.gmail.com", 465, $errno,  $errstr, 10);
        if(empty($content)){
            $content=$this->Content;
        }
 

        try {
            $options = new Mail\Transport\SmtpOptions(array(
                'name' => 'smtp.gmail.com',
                'host' => 'smtp.gmail.com',
                'port' => 587,
                'connection_class' => 'login',
                'connection_config' => array(
                    'username' => 'inscriptionuvt@gmail.com',
                    'password' => 'uvt_scolarite(125)',
                    'ssl' => 'tls',
                ),
            ));





// make a header as html
            $html = new MimePart($content);
            $html->type = "text/html";
            $body = new MimeMessage();
            $body->setParts(array($html));
// instance mail
            $mail = new Mail\Message();
            $mail->setBody($body); // will generate our code html from template.phtml
            //sender email, sender name
            $mail->setFrom($this->From, $this->NameFrom);
            $mail->setTo($this->To);
            $mail->setCc($this->Cc);
            $mail->setBcc($this->Bcc);
            $mail->setSubject($this->Subject);
           //echo "sending  <br>$content";
            $transport = new Mail\Transport\Smtp($options);
            $v=$transport->send($mail);
            return $v;

        }catch (\Exception $e){
            error_log("Erreur d'envoi de mail : ".$e->getMessage());
             return false;
        }
    }

}