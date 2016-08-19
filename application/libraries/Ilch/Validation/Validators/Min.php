<?php
/**
 * @copyright Ilch 2.0
 */

namespace Ilch\Validation\Validators;

/**
 * Min validation class.
 */
class Min extends Base
{
    protected $errorKey = 'validation.errors.min.numeric';
    protected $minParams = 1;
    protected $maxParams = 2;

    public function run()
    {
        $numberString = isset($this->params[1]) && $this->params[1] === 'string' ? true : null;

        return [
            'result' => $this->value === '' || $this->getSize($this->value, $numberString) >= (int) $this->params[0],
            'error_key' => $this->getErrorKey($this->data),
            'error_params' => [[$this->params[0]]],
        ];
    }

    protected function getSize($value, $numberString = null)
    {
        if (is_numeric($value) && !$numberString) {
            return (int) $value;
        } elseif (is_array($value)) {
            $this->errorKey = 'validation.errors.min.array';

            return count($value);
        }

        $this->errorKey = 'validation.errors.min.string';

        return mb_strlen($value);
    }
}
