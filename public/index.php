<?php

require '../vendor/autoload.php';
require '../core/bootstrap.php';

use Ali\TalabashAssignment\Form\Form;
use Ali\TalabashAssignment\Payment\Callback;
use Ali\TalabashAssignment\Payment\Payment;
use Ali\TalabashAssignment\Payment\Transactions;
use Core\Request;

match (Request::uri()) {
    'pay' => (new Payment)->submit(),
    'callback' => (new Callback)->callback(),
    'transactions' => (new Transactions)->display(),
    default => (new Form())->display()
};

