<?php


namespace CasparOne\CheckBrackets;

/**
 * Class BracketChecker
 * @package CasparOne\CheckBrackets
 */
class BracketChecker
{
    protected $tuple;

    /**
     * BracketChecker constructor.
     * @param string $tuple
     */
    public function __construct(string $tuple)
    {
        $this->tuple = preg_replace('~[\s]~', '', trim($tuple));
    }

    /**
     * @return bool
     */
    public function check() : bool
    {
        $strlen = strlen($this->tuple);
        $counter = 0;
        if (false == $this->checkString() ) {
            throw new InvalidArgumentException('Wrong string input!', 01);
        }

        for ($i=0; $i < $strlen; $i++) {
            switch ($this->tuple[$i]) {
                case '(':
                    $counter++;
                    break;
                case ')':
                    $counter--;
                    break;
            }
            if (0 > $counter) {
                return false;
            }
        }
        return 0 === $counter;

    }

    /**
     * @return bool
     */
    public function checkString() : bool
    {
        return preg_match('~^[\\)\\(\\s]+$~', $this->tuple);
    }

}