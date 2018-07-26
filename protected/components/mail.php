<?php
class mail
{
    // public $host = 'mail.trimegah.com';
    // public $port = 465;
    // public $protocol = 'ssl';
    //public $host = '172.16.137.11';
    //public $port = 25;
    // public $username = 'reksa.dana.online@trimegah.com';
    // public $password = 'Tramrdo123';
    // public $from = array('reksa.dana.online@trimegah.com'=>'noreply');
        //ori
        // public $host = 'smtp.gmail.com';
        // public $port = 465;
        // public $protocol = 'ssl';
        // public $username = 'praisindotesting@praisindo.com';
        // public $password = 'praisindo2015';
        // public $from = array('nonreply@praisindo.com'=>'noreply');
                        public $host = 'localhost';
                        public $port = 25;
                        // public $protocol = 'smtp';
                        public $username = 'fajar@localhost';
                        public $password = 'indratmo';
                        public $from = array('fajar@localhost'=>'noreply');
        //End Ori
    /*
     *  @param string   template
     *  @param array    valToBind
     *  @param string   to
     */
    public function send($template,$valToBind=null,$to=null){
        // print_r($valToBind['name']);exit;
        spl_autoload_unregister(array('YiiBase', 'autoload')); // Disable Yii autoloader
        Yii::import('application.vendors.*');
        include('swift/swift_required.php');    
        
        // $transport =    Swift_SmtpTransport::newInstance($this->host,$this->port,$this->protocol)
        $transport =    Swift_SmtpTransport::newInstance($this->host,$this->port) //for local(non SSL/TLS)
                        ->setUsername($this->username)
                        ->setPassword($this->password);
        $mailer = Swift_Mailer::newInstance($transport);

        // Read message template
        spl_autoload_register(array('YiiBase', 'autoload')); // Register Yii autoloader
        /*$model = new TblRdoEmail();*/
        //$msgSource = simplexml_load_file(Yii::app()->basePath.DIRECTORY_SEPARATOR.'mail_template'.DIRECTORY_SEPARATOR.$template.'.xml');
        //$content = $msgSource->content;
        // $msgSource = $model->findByAttributes(array('template'=>$template));
        // $content = $msgSource->content;

        //parameter binding to message
        //$arrayTo = explode(',',$msgSource->to); //to send email to multiple user
        /*$msgSource->to = $this->bindParams($msgSource->to,$valToBind);
        $msgSource->cc = $this->bindParams($msgSource->cc,$valToBind);
        $arrayTo = explode(',',$msgSource->to); //to send email to multiple user
        $sendTo = empty($to)?$arrayTo:$to;
        $msg = html_entity_decode($this->bindParams($content,$valToBind));
        $subject = html_entity_decode($this->bindParams($msgSource->subject,$valToBind));*/

        $message = Swift_Message::newInstance($valToBind['subject'])
                        ->setFrom($valToBind['from'])
                        ->setTo($valToBind['to'])
                        ->setBody($template,'text/html');
                        // ->setCharset('iso-8859-2');
        // print_r($message);exit;
         //log mail
        $sendStatus = null;
        try{
            /** == MATIKAN EMAIL UNTUK XDANA == */
            $sendStatus = $mailer->send($message);
            /** ================ */
        }catch(Exception $e){
            // print_r($e);exit;
            return $sendStatus;
        }
        return $sendStatus;
    }
    
    protected function bindParams($string,$param=null){
        //Jika null maka data bisa di provide oleh return value dari web service
        if(is_null($param))
            $param = array('param_name'=>'param_name','param_address'=>'Reksadana Online');
        
        foreach($param as $key => $val){
            $string = str_replace('{'.$key.'}',$val,$string);
        }
        
        return $string;
    }
}
?>