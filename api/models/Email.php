<?php
class Email
{
    function send($payload, $print = false)
    {
        $con =  new Banco;
        $ID = intval($payload['instituicao_id'] ?? 0);
        $sql = "SELECT * FROM smtp WHERE id=$ID";
        $query = $con->query($sql);

        $smtp = [
            'instituicao_id' => 1,
            'host' => 'smtp.hostinger.com.br',
            'porta' => 587,
            'usuario' => 'contato@digitalcombo.com.br',
            'senha' => null,
            'nome' => 'Doar Digital'
        ];

        if (!empty($query[0])) {
            $inst_smtp = $query[0];
            $smtp['usuario'] = $inst_smtp['usuario'];
            $smtp['nome'] = $inst_smtp['nome'];
        }

        $payload = array_merge([
            'instituicao_color' => '#C00',
            'instituicao_nome' => 'Nome Instituicao',
            'categoria' => 'Email de teste',
            'conteudo' => '...',
            'link' => 'link',
            'from_email' => '',
            'from_nome' => ''
        ], $payload);

        $payload['from_email'] = $smtp['usuario'];
        $payload['from_nome'] = $smtp['nome'];

        $payload = (object) $payload;
        $subject = "{$payload->instituicao_nome} - Doação Processada";
        $headers = "MIME-Version: 1.0 \r\n";
        $headers .= "Content-type: text/html; charset=utf-8 \r\n";
        $message = file_get_contents(__DIR__ . "/../static/template-email.html");
        $message = $this->template($payload, $message);
        $headers .= "To: Doador <{$payload->email}> \r\n";
        $headers .= "From: {$payload->from_nome} <{$payload->from_email}> \r\n";
        try {
            @mail($payload->email, $subject, $message, $headers);
        } catch (\Throwable $th) {
        }
        if ($print) {
            echo $message;
        }
    }

    function template($payload, $html)
    {
        foreach (array_keys((array)$payload) as $k) {
            $html = str_replace("{{" . $k . "}}", $payload->{$k}, $html);
        }
        $html = str_replace("%20", '', $html);
        return $html;
    }
}
