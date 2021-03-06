<?php

header('Content-Type: text/html; charset=utf-8');
header('Access-Control-Allow-Origin: *');
date_default_timezone_set('America/Sao_Paulo');


include __DIR__ . "/api/core/BancoM.php";
include __DIR__ . "/api/core/Banco.php";
include __DIR__ . "/api/models/Email.php";
include __DIR__ . "/api/models/Instituicao.php";


function email_recuperacao()
{
    $now = date('Y-m-d H:i');
    $con = new Banco;
    $sql = "SELECT * FROM recuperacao_doacao  WHERE data_para_envio LIKE '%$now%'";

    $instituicao = new Instituicao;
    $email = new Email;

    $result = $con->query($sql);
    
    foreach( $result as $enviar ) {
        $info = $instituicao->get($enviar['instituicao_id']);
        $configuracao = $instituicao->config($enviar['instituicao_id']);
        $payload = [
            "instituicao_color"=> $configuracao->cor_main ?? '#CCC',
            "instituicao_nome"=> $configuracao->title ?? 'Nome Instituição',
            "categoria"=> '',
            "instituicao_id"=> $enviar['instituicao_id'],
            "instituicao_logo"=> $configuracao->logo ?? '',
            "from_email"=> $info["email"] ?? '',
            "from_nome"=> $configuracao->title ?? '',
            "email" => $enviar["email"]
        ];
        $payload['conteudo'] = "
            Olá, Obrigada por visitar nossa página! 
            Somos uma instituição que vive exclusivamente das doações 
            recebidas, para manter a obra funcionando. 
            <br>
            Os recursos são escassos e a providência divina tem tocado muitos 
            corações desejosos de fazer essa experiência da doação, 
            para que tudo se mantenha ativo e que mais vidas sejam 
            salvas para Jesus! Por vezes queremos fazer muito mais, 
            entretanto temos que aguardar que as promessas de Deus se cumpram, 
            no tempo dele e não no nosso. 
            <br>
            Mas Ele nos surpreende e cuida de nós com muito carinho, 
            quando você chega até nós e se mostra interessado em ajudar. <br>
            Apenas por você ter nos visitado aqui, já somos gratos.
            <br>
            Esperamos que a providência divina também se faça 
            presente na sua vida e que você consiga finalizar a intenção de fazer 
            parte dos doadores. 
            <br>
            Já rezamos muito nas necessidades de cada um, pois acreditamos 
            que juntos podemos fazer maravilhas pelos que precisam. 
            Nós não existiríamos sem vocês e todo nosso trabalho ficaria sem 
            sentido se não tivéssemos a ajuda de irmãos tão comprometidos! 
            Estamos falando de um exército de doadores, fortalecidos pelo poder da oração, 
            sustentando filhos necessitados de amor e atenção, 
            gerando mais e mais almas restauradas para o reino de Deus. 
            <br>
            Obrigada por estar conosco! Um abraço fraterno
        ";
        $payload['link'] = "para finalizar sua doação <a href=\"https://{$info['subdominio']}.doardigital.com.br/finalizar.html\">Clique aqui</a>";

        $email->send($payload, false);
    }
}

email_recuperacao();


echo json_encode([
    "next" => true
]);
