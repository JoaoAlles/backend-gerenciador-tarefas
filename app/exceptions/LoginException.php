<?php

class LoginException
{
    public const MESSAGES = [
        406 => 'Por favor, preencha o campo %s.',
        403 => 'A fatura selecionada não pertence ao cliente',
        409 => 'A fatura já foi paga.',
        410 => 'Erro ao realizar o pagamento. Tente novamente em %s segundos.'
    ];
}