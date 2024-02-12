<?php

namespace Ali\TalabashAssignment\Payment;

use Core\Core;
use Exception;

class Payment extends Core
{
    /**
     * The payment token.
     *
     * @var string
     */
    private string $token;

    /**
     * @throws Exception
     */
    public function submit(): void
    {
        $this->validatePayment();
        $this->insertTransaction();

        header("Location: /callback?token=$this->token");
    }

    public function insertTransaction(): void
    {
        $this->token = uniqid();

        $this->db->insert('transactions', [
            "amount" => $_POST['amount'],
            "success" => 0,
            "callback_token" => $this->token
        ]);
    }

    /**
     * @return void
     * @throws Exception
     */
    private function validatePayment(): void
    {
        $this->validate([
            'amount' => 'number'
        ]);
    }
}