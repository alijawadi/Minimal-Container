<?php

namespace Ali\TalabashAssignment\Payment;

use Core\Core;

class Transactions extends Core
{
    public function display()
    {
        $this->html();
    }

    protected function retrieveTransactions()
    {
        return $this->db->selectAll('transactions');
    }

    private function html()
    {
        echo <<<html
                <!DOCTYPE html>
                <html lang="fa" dir="rtl">
                    <head>
                        <link rel="preconnect" href="https://fonts.googleapis.com">
                        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
                        <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
                        <title>تراکنش ها</title>

                        <style>
                            body {
                              font-family: Rubik, arial, sans-serif;
                              direction: rtl;
                            }
                            table {
                              margin: 0 auto;
                              border-collapse: collapse;
                              width: 50%;
                            }
                            
                            td, th {
                              border: 1px solid #dddddd;
                              text-align: left;
                              padding: 8px;
                            }
                            
                            tr:nth-child(even) {
                              background-color: #dddddd;
                            }
                        </style>
                    </head>
                    <body>
                                
                <table>
                  <tr>
                    <th>شماره تراکنش</th>
                    <th>مبلغ تراکنش</th>
                    <th>وضعیت تراکنش</th>
                    <th>آخرین به روز رسانی</th>
                  </tr>
html;
       $this->tableDataRows();

       echo <<<html
              
                    </table>
                    
                    </body>
                </html>

html;
    }

    private function tableDataRows(){
        foreach ($this->retrieveTransactions() as $value) {
            echo "<tr>
                <td>$value->id</td>
                <td>$value->amount</td>
                <td>$value->success</td>
                <td>$value->updated_at</td>
                </tr>";
        }
    }
}