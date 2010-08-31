<?php
/**
 * Will each given value in order.
 * If the end of the list is reached, the last
 * value in the list will be returned indefinitely.
 */
class BuiltinMock_Returner_Queue extends BuiltinMock_Returner_SetValue
{
	/**
	 * @var array
	 */
	protected $aValues;

	/////////////////////////////////////////////////////////////////////////////
	// PUBLIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create the object and set the initial value and list of subsequent values
	 *
	 * @param array $aValues    required=true
	 */
	public function __construct($aValues)
	{
		$this->aValues = $aValues;
		$this->setValue(array_shift($this->aValues));
	}

	/**
	 * Return the set value
	 *
	 * @return mixed
	 */
	public function mock($aArgs)
	{
		$mValue = parent::mock($aArgs);
		if (count($this->aValues) > 0) {
			$this->setValue(array_shift($this->aValues));
		}
		return $mValue;
	}
}

?>
