<?php
/**
 * Will return the set value on every call
 */
class BuiltinMock_Returner_SetValue extends BuiltinMock_Function
{
	/**
	 * @var mixed
	 */
	protected $mValue;
	
	/////////////////////////////////////////////////////////////////////////////
	// PUBLIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Create the object and set the initial value
	 *
	 * @param mixed $mValue    required=true
	 */
	public function __construct($mValue)
	{
		$this->setValue($mValue);
	}
	
	/**
	 * Return the set value
	 *
	 * @return mixed
	 */
	public function mock($aArgs)
	{
		return $this->mValue;
	}

	/////////////////////////////////////////////////////////////////////////////
	// PROTECTED ///////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Set the value that will be returned on calls to $this->mock()
	 *
	 * @param mixed $mValue    required=true
	 */
	protected function setValue($mValue)
	{
		$this->mValue = $mValue;
	}	
}
?>
