<?php

namespace Ali\TalabashAssignment\Payment;

use Core\Core;

class Callback extends Core
{
    /**
     * @throws \Exception
     */
    public function callback(): void
    {
        $token = $_GET['token'];

        // starting a transaction and locking the row to prevent race condition.
        try {
            $this->db->beginTransaction();
            //locking
            $dbToken = $this->retrieveToken($token);
            if (!$dbToken || $dbToken->success) {
                echo "<h1>تراکنش اشتباه</h1>";
                die;
            } else {
                $this->updateStatus($dbToken->id);
                echo "<h1>تراکنش اشتباه</h1> <br>";
                echo "<button><a href='/transactions'>مشاهده تراکنش ها</a></button>";
            }
            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollback();
            die($e->getMessage());
        }
    }

    protected function retrieveToken(string $token)
    {
        // sending true as the fourth argument will lock the column.
        return $this->db->select('transactions', 'callback_token', $token, true);
    }

    protected function updateStatus(int $id)
    {
        return $this->db->update('transactions', $id, [
            'success' => 1
        ]);
    }
}