<?php
namespace PhpNwSykes;

class RomanNumeral
{
    protected $symbols = [

	'M' => 1000,
	'D' => 500,
	'C' => 100,
	'L' => 50,
	'X' => 10,
	'V' => 5,
	'I' => 1,
    ];

    protected $numeral;

    public function __construct(string $romanNumeral)
    {
        $this->numeral = $romanNumeral;
    }

    /**
     * Converts a roman numeral such as 'X' to a number, 10
     *
     * @throws InvalidNumeral on failure (when a numeral is invalid)
     */
    public function toInt():int
    {
	$total = 0;
	$numLen = strlen($this->numeral);

	try
	{
		// throw if string is empty or last char invalid numeral
		if($numLen < 1 || !array_key_exists($this->numeral[$numLen-1], $this->symbols))
			throw new InvalidNumeral();

	        $total = $this->symbols[$this->numeral[$numLen-1]];

		for ($i = $numLen-2; $i >= 0 ; --$i)
		{
			// throw if char is invalid numeral
			if(!array_key_exists($this->numeral[$i], $this->symbols))
				throw new InvalidNumeral();

			// if out of descending order (front to back) then subtract
			if($this->symbols[$this->numeral[$i]] < $this->symbols[$this->numeral[$i+1]])
				$total -= $this->symbols[$this->numeral[$i]];
			else
				$total += $this->symbols[$this->numeral[$i]];
		}

    	}catch(Exception $e){echo $e->getMessage();}

	return $total;
    }
}
