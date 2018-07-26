<?php
class mail
{
    // public $host = 'mx.praisindo.com';
    // public $port = 25;
    // public $protocol = 'smtp';
    // public $username = 'putera.harri@praisindo.com';
    // public $password = 'pratama';
    // public $from = array('nonreply@praisindo.com'=>'noreply');
        public $host = 'localhost';
        public $port = 25;
        // public $protocol = 'smtp';
        public $username = 'fajar@localhost';
        public $password = 'indratmo';
        public $from = array('fajar@localhost'=>'noreply');
    public $isTemplate = true;
    public $msgTo;
    public $msgContent;
    public $msgSubject;
    
    /*
     *  @param string   template
     *  @param array    valToBind
     *  @param string   to
     */
    public function send($template,$valToBind=null,$to=null){
        spl_autoload_unregister(array('YiiBase', 'autoload')); // Disable Yii autoloader
        Yii::import('application.vendors.*');
        include('swift/swift_required.php');	
        
        // $transport =    Swift_SmtpTransport::newInstance($this->host,$this->port,$this->protocol)
        $transport =    Swift_SmtpTransport::newInstance($this->host,$this->port)
                        ->setUsername($this->username)
                        ->setPassword($this->password);
        $mailer = Swift_Mailer::newInstance($transport);

        if(!$this->isTemplate){
            $content = $template;
        }else{
            // Read xml message template
            $msgSource = simplexml_load_file(Yii::app()->basePath.DIRECTORY_SEPARATOR.'mail_template'.DIRECTORY_SEPARATOR.$template.'.xml');
            $content = $msgSource->content;
            
            //parameter binding to message
            $arrayTo = explode(',',$msgSource->to); //to send email to multiple user
            $this->msgTo = is_null($to)?$arrayTo:$to;
            $this->msgContent = html_entity_decode($this->bindParams($content,$valToBind));
            $this->msgSubject = html_entity_decode($this->bindParams($msgSource->subject,$valToBind));
        }       
        $message = Swift_Message::newInstance($this->msgSubject)
                        ->setFrom($this->from)
                        ->setTo($this->msgTo)
                        ->setBody($this->msgContent,'text/html');
        
        spl_autoload_register(array('YiiBase', 'autoload')); // Register Yii autoloader
        
        // Send the message
        $result = $mailer->send($message);
    }
    
    protected function bindParams($string,$param=null){
        //Jika null maka data bisa di provide oleh return value dari web service
        if(is_null($param))
            $param = array('param_name'=>'param_name','param_address'=>'TEST');
        
        foreach($param as $key => $val){
            $string = str_replace('{'.$key.'}',$val,$string);
        }
        
        return $string;
    }
}
?>