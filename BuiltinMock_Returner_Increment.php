<?php
/**
 * Will return the set value in increments
 */
class BuiltinMock_Returner_Increment extends BuiltinMock_Returner_SetValue
{
	/**
	 * @var integer
	 */
	protected $iStep;

	/////////////////////////////////////////////////////////////////////////////
	// PUBLIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create the object and set the initial value and increment step
	 *
	 * @param integer $iValue    required=true
	 * @param integer $iStep     amount to increase the value on subsequent calls required=false
	 */
	public function __construct($iValue, $iStep=1)
	{
		parent::__construct($iValue);
		$this->iStep = $iStep;
	}

	/**
	 * Return the set value
	 *
	 * @return integer
	 */
	public function mock($aArgs)
	{
		$iValue = parent::mock($aArgs);
		$this->setValue($iValue + $this->iStep);
		return $iValue;
	}
}

?>
