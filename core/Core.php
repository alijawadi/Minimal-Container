<?php

namespace Core;

use Exception;

class Core
{
    /**
     * Bind all container values.
     */
    public function __construct()
    {
        foreach (Container::getRegistry() as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * @throws Exception
     */
    protected function validate(array $params): void
    {
        foreach ($params as $key => $value) {
            $this->validateExists($key);

            if ($value === 'number') {
                $this->validateAmount($key);
            }
        }
    }

    /**
     * @throws Exception
     */
    protected function validateExists($key): void
    {
        if (empty($_POST[$key])) {
            throw new Exception("The $key parameter required.");
        }
    }

    /**
     * @throws Exception
     */
    protected function validateAmount($key): void
    {
        $number = $_POST[$key];

        var_dump($number);
        if (is_numeric($number) && $number < 0) {
            throw new Exception("The $key should be a valid number and bigger than 0.");
        }
    }
}