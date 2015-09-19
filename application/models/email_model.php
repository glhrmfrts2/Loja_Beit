<?php 

	class email_model extends CI_Model {

    public $body = '';

    function __construct(){
        parent::__construct();

    }    

    public function sendMail($para, $assunto,$from){
        $this->load->library('phpmailer');

        $this->phpmailer->IsSMTP();
        $this->phpmailer->Host = "smtp.iscooftalmologia.com.br";
        $this->phpmailer->SMTPAuth = true;
        $this->phpmailer->Username = 'auth@iscooftalmologia.com.br';
        $this->phpmailer->Password = 'olhoquetudove6';
        $this->phpmailer->Port = 587;

        foreach ($para as $k => $value) {
            $this->phpmailer->AddAddress($value);
        }
        
        $this->phpmailer->IsHTML();
        $this->phpmailer->From = "contato@iscooftalmologia.com.br";
        $this->phpmailer->FromName = $from;
        $this->phpmailer->Subject  = utf8_decode($assunto);
        $this->phpmailer->Body = utf8_decode($this->body);

        if(!$this->phpmailer->Send()){
          return false;
        }else{
          return true;
        }        
    }


    public function getBody($titulo,$autoResp=NULL)
    {   
        // Monta corpo do E-mail
    $body = "<body>" .
                    "<div align=\"center\">" .
                        "<table width=\"600\" border=\"0\" cellspacing=\"2\" cellpadding=\"4\">" .
                            "<tr>" .
                                "<td colspan=\"2\" bgcolor=\"#CCCCCC\">" .
                                    "<font size=\"4\" face=\"Verdana\">" .
                                    $titulo .
                                    "</font>" .
                                "</td>" .
                            "</tr>" ;

                //destroi a variavel do submit
                unset($_POST['btn-submit']);
                //Preenche os Campos do Formulario
                foreach($_POST as $campo => $valor){
                    if($campo != 'btn-submit'){
                        $campo = ucfirst($campo).': ';
                        $body= $body.   "<tr>" .
                                          "<td width=\"100\">" .
                                              "<font size=\"2\" face=\"Verdana\">" .
                                              "<b>$campo</b>" .
                                              "</font>" .
                                          "</td>";

                                        $var = strip_tags($valor);
                                                    
                        $body=$body.      "<td>" .
                                                            "<font size=\"2\" face=\"Verdana\">" .
                                                                "$var" .
                                                            "</font>" .
                                                        "</td>" .
                                                    "</tr>" ;
                    }

                };                                                                                                          
    $body = $body.  
                        "</table>" .    
                    "</div>" .
                "</body>".
            "</html>";
        if ($autoResp != NULL) {
            return $this->body = $autoResp;
        }else{
            return $this->body = $body;
        }
    }
  }