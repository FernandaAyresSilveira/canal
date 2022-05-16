<?php 
/* ==================== FUNÇÕES GLOBAIS ==================== */


           /* ===== FUNÇÃO PADRÃO DE ENVIO DE E-MAIL ===== */
        function enviar_email($assunto ,$mensagem, $destinatario){   
           
            require_once('./assets/php/phpmailer/PHPMailerAutoload.php');
/*
            $mail = new PHPMailer();
            //$mail->IsSMTP();
            //$mail->SMTPDebug = 0;
           // $mail->Debugoutput = 'html';
            $mail->Host = "localhost";
           // $mail->Port = 25;
            $mail->SMTPAuth = true;
            $mail->Username = $configuracao->email_smtp; //email cadastrado no servidor
            $mail->Password = $configuracao->senha_smtp; // senha cadastrada no servidor
            $mail->From     = $configuracao->email_smtp; // Remetente Email
            $mail->FromName = utf8_decode($configuracao->titulo); // titulo da mensagem
            $mail->AddAddress($destinatario, ''); //Destinatário
            $mail->WordWrap = 50; 
            $mail->IsHTML(true); //enviar em HTML
            $mail->AddReplyTo($configuracao->email_smtp, '');  //e-mail e nome de resposta
            $mail->Subject = $assunto; //ASSUNTO
            //adicionando o html no corpo do email
            $mail->Body = $mensagem;

            if($mail->Send())
                return true;
            else
                return false;*/

            /*$headers = "MIME-Version: 1.0\r\n";
            $headers .= "Content-type: text/html;charset=iso-8859-1\r\n";
            $headers .= "From: contato@pontodogibi.com.br \r\n";
            
            $assunto   = $assunto;
            $header = $mensagem;


            $erro= 0;
            if (!mail($destinatario, $assunto, utf8_decode($header), $headers)) {
                $erro++;
                
            }

            if (!mail('contato@pontodogibi.com.br', $assunto, utf8_decode($header), $headers)) {
                $erro++;
                
            }


            if ($erro > 0) {
                return false;
            }else{
                return true;
            }*/

            $erro= 0;

            $mail = new PHPMailer;
          /*  $mail->IsSMTP();
            $mail->Host = "pontodogibi.com.br";
            $mail->SMTPAuth = true;
            $mail->Username = 'contato@pontodogibi.com.br'; //email cadastrado no servidor
            $mail->Password = '12082012'; // senha cadastrada no servidor
            $mail->SMTPDebug = 0;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Debugoutput = 'html';
            $mail->From = ('contato@pontodogibi.com.br'); // Remetente Email
            $mail->FromName = utf8_decode("Ponto do Gibi - Loja de quadrinhos");
            $mail->AddReplyTo('contato@pontodogibi.com.br',"Ponto do Gibi");  //e-mail e nome de resposta   
            $mail->AddAddress($destinatario); //Destinatário
            $mail->Subject = utf8_decode( $assunto); //ASSUNTO
            $mail->IsHTML(true); //enviar em HTML
            $mail->Body = utf8_decode( $mensagem );*/

            if(!$mail->send()) {
               $erro++;
            }


            $mail = new PHPMailer;
            $mail->IsSMTP();
           /* $mail->Host = "pontodogibi.com.br";
            $mail->SMTPAuth = true;
            $mail->Username = 'contato@pontodogibi.com.br'; //email cadastrado no servidor
            $mail->Password = '12082012'; // senha cadastrada no servidor
            $mail->SMTPDebug = 0;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Debugoutput = 'html';
            $mail->From = ('contato@pontodogibi.com.br'); // Remetente Email
            $mail->FromName = utf8_decode("Ponto do Gibi - Loja de quadrinhos");
            $mail->AddReplyTo('contato@pontodogibi.com.br',"Ponto do Gibi");  //e-mail e nome de resposta   
            $mail->AddAddress($destinatario); //Destinatário
            $mail->Subject = utf8_decode( $assunto); //ASSUNTO
            $mail->IsHTML(true); //enviar em HTML
            $mail->Body = utf8_decode( $mensagem );*/

            if(!$mail->send()) {
               $erro++;
            }

            $mail = new PHPMailer;
          /*  $mail->IsSMTP();
            $mail->Host = "pontodogibi.com.br";
            $mail->SMTPAuth = true;
            $mail->Username = 'contato@pontodogibi.com.br'; //email cadastrado no servidor
            $mail->Password = '12082012'; // senha cadastrada no servidor
            $mail->SMTPDebug = 0;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->Debugoutput = 'html';
            $mail->From = ('contato@pontodogibi.com.br'); // Remetente Email
            $mail->FromName = utf8_decode("Ponto do Gibi - Loja de quadrinhos");
            $mail->AddReplyTo('contato@pontodogibi.com.br',"Ponto do Gibi");  //e-mail e nome de resposta   
            $mail->AddAddress($destinatario); //Destinatário
            $mail->Subject = utf8_decode( 'Aviso de admin: '.$assunto); //ASSUNTO
            $mail->IsHTML(true); //enviar em HTML
            $mail->Body = utf8_decode( $mensagem );*/

            if(!$mail->send()) {
               $erro++;
            }

             if ($erro > 0) {
                return false;
            }else{
                return true;
            }


        }
        /* ===== FIM FUNÇÃO PADRÃO DE ENVIO DE E-MAIL ===== */

        

        /* ===== FUNÇÃO PADRÃO DE UPLOAD ===== */
        function upload( $pasta, $fonte, $nome, $tamanho_max = '0' ){
            /* PASTA = A partir de assets/upload */
            /* FONTE = Nome do campo do arquivo */
            /* NOME = Nome para salvar o arquivo */
            
            $config['upload_path']   = "./../admin/assets/upload/$pasta";
            $config['allowed_types'] = '*';
            $config['file_name']     = $nome;           
            $config['max_size']      = $tamanho_max;
            $config['max_width']   = '1000000000000';
            $config['max_height']    = '1000000000000';
            $config['overwrite']     = true;

            $CI = get_instance();
            $CI->load->library('upload', $config);
            $CI->upload->initialize($config);

            return $CI->upload->do_upload($fonte);

        }
        /* ===== FIM FUNÇÃO PADRÃO DE UPLOAD ===== */


            /*$config['image_library']  = 'gd2';
            $config['source_image']   = "./assets/upload/$pasta/$arquivo";
            $config['wm_type'] = 'overlay';
            $config['wm_overlay_path'] = "./assets/upload/marcadagua/marcadagua.png";
            $config['wm_hor_alignment'] = 'right';
            $config['wm_padding'] = '-20';
            

            $CI = get_instance();
            $CI->load->library('image_lib', $config); 
            $CI->image_lib->watermark();*/



        /* ===== FUNÇÃO NOME DA IMAGEM AMIGÁVEL ===== */

        function nome_imagem($imagem){
            $extensao = explode(".", $imagem);
            $extensao = strtolower( pathinfo($imagem, PATHINFO_EXTENSION) );

            $nomeImagem = str_replace(".".$extensao, "", $imagem);

            $imagemNome = amigavel($nomeImagem)."-".rand(0, 999);
            return $imagemNome.".".$extensao;

        }

        /* ===== FUNÇÃO AMIGAVEL ===== */
        function amigavel($str){

            $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
 
             $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');

            $str= str_replace($a, $b, $str);


            $friendlyURL = htmlentities($str, ENT_COMPAT, "UTF-8", false); 
            $friendlyURL = preg_replace('/&([a-z]{1,2})(?:acute|lig|grave|ring|tilde|uml|cedil|caron);/i','\1',$friendlyURL);
            $friendlyURL = html_entity_decode($friendlyURL,ENT_COMPAT, "UTF-8"); 
            $friendlyURL = preg_replace('/[^a-z0-9-]+/i', '-', $friendlyURL);
            $friendlyURL = preg_replace('/-+/', '-', $friendlyURL);
            $friendlyURL = trim($friendlyURL, '-');
            $friendlyURL = strtolower($friendlyURL);
            return $friendlyURL;

        }
        /* ===== FIM FUNÇÃO AMIGAVEL ===== */


        /* ===== FUNÇÃO BUSCAR THUMB ===== */
        /* Recebe o nome da imagem e retorna o nome da imagem thumb. EX: 2139812.jpg, retorna 2139812_thumb.jpg */
        function buscar_thumb($imagem){
            $thumb = explode('.', $imagem);
            return "$thumb[0]_thumb.$thumb[1]";
        }
        /* ===== FIM FUNÇÃO BUSCAR THUMB ===== */


         function criar_thumb($id, $imagem){

             require_once('./assets/php/easyphp/easyphpthumbnail.class.php');

             $thumb = explode('.', $imagem);

             $caminho = './../admin/assets/upload/anuncios/'.$id.'/'.$thumb[0].".".$thumb[1];
            $caminho_thimb = './../admin/assets/upload/anuncios/'.$id.'/'."mini_";


            // echo $caminho;

            $thumb = new easyphpthumbnail;
            $thumb->Thumbheight = 175;
            $thumb->Thumblocation =  $caminho_thimb;
            $thumb->Quality = 100;
            //$thumb->Thumbprefix = '_thumb_';
            ///$thumb->Thumbsaveas = $thumb[1];

            $thumb->Createthumb($caminho, 'file');

        }



         /* ===== FUNÇÃO EXTENSÃO ===== */
        function extensao($arquivo){

            return strtolower( pathinfo($arquivo, PATHINFO_EXTENSION) );

        }
        /* ===== FIM FUNÇÃO EXTENSÃO ===== */



        /* ===== FUNÇÃO CONVERTER DATA ===== */
        function converter_data($entrada){
            /* Converte para o formato OPOSTO. Exemplo: 28/08/1990 para 1990-08-28 e vice-versa. */

            if($entrada) {
                if( strpos($entrada, '-') === false ){//Converte para o formato 1990-08-28
                    $saida = explode('/', $entrada);
                    return "$saida[2]-$saida[1]-$saida[0]";
                }
                else {//Converte para o formato 28/08/1990
                    if( strpos($entrada, ':') === false ){//Se não tiver hora converte normalmente
                        $saida = explode('-', $entrada);
                        return "$saida[2]/$saida[1]/$saida[0]";
                    }
                    else{//Se tiver a hora separa ela da data e converte os dois
                        $saida = explode(' ', $entrada);
                        $data  = explode('-', $saida[0]);
                        $hora  = explode(':', $saida[1]);
                        return "$data[2]/$data[1]/$data[0] $hora[0]:$hora[1]";
                    }                
                }
            }
            else
                return false;
        }


        function data_simples($entrada){
            $data= explode(' ', $entrada);
            $saida = explode('-', $data[0]);
            $hora  = explode(' ', $saida[1]);
            return "$saida[0]-$saida[1]-$saida[2]";

          
        }
        function dia($entrada){
            $data = data_simples($entrada);
            $data = explode('-', $data);

            return $data[2];
        }
        function mes($entrada){
            $data = data_simples($entrada);
            $data = explode('-', $data);
            $mes = $data[1];
            $nome_mes = '';

            switch ($mes) {
                case '1':
                   $nome_mes = "Jan";
                    break;
                case '2':
                   $nome_mes = "Fev";
                    break;
                case '3':
                   $nome_mes = "Mar";
                    break;
                case '4':
                   $nome_mes = "Abr";
                    break;
                case '5':
                   $nome_mes = "Mai";
                    break;
                case '6':
                   $nome_mes = "Jun";
                    break;
                case '7':
                   $nome_mes = "Jul";
                    break;
                case '8':
                   $nome_mes = "Ago";
                    break;
                case '9':
                   $nome_mes = "Set";
                    break;
                case '10':
                   $nome_mes = "Out";
                    break;
                case '11':
                   $nome_mes = "Nov";
                    break;
                case '12':
                   $nome_mes = "Dez";
                    break;
                default:
                    $nome_mes = "Jan";
                    break;
            }
            return $nome_mes;
        }
        /* ===== FIM FUNÇÃO CONVERTER DATA ===== */

        /* ===== FUNÇÃO CAMINHO IMAGEM ===== */
        function base_url_upload($entrada){
            /* retorna o caminho padrão da pasta de upload */

            return base_url("./../admin/assets/upload/".$entrada);

        }
        /* ===== FIM FUNÇÃO CAMINHO IMAGEM ===== */

        function mostrar_valor($valor){
           return number_format($valor,2,',','.');
        }

        function  formatar_valor($valor){
           $valor =  str_replace('.','',$valor);
           return str_replace(',','.',$valor);
        }



        

        /* ==================== FIM FUNÇÕES GLOBAIS ==================== */
?>