<?php
/**
 * Base class of builtin mocks
 * Child classes must create the mock() function.
 */
abstract class BuiltinMock_Function
{
	/**
	 * Name that can be used to call the original function being mocked
	 * @var string
	 */
	protected $sOriginal;

	/////////////////////////////////////////////////////////////////////////////
	// ABSTRACT ////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * This defines the action that the mocked function will take when called.
	 *
	 * mock() methods should include the expected parameters in their
	 * docblocks, as usual.
	 *
	 * @param array $aArgs    required=true
	 * @return mixed
	 */
	abstract public function mock($aArgs);

	/////////////////////////////////////////////////////////////////////////////
	// PUBLIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Method that calls the original function
	 *
	 * @param array $aArgs    array of arguments to be passed to the function required=false
	 * @return mixed return of the original function
	 */
	public function callOriginal($aArgs=array())
	{
		return call_user_func_array($this->sOriginal, $aArgs);
	}

	/**
	 * Set the name that can be used to call the original function
	 *
	 * @param string $sOriginal    required=true
	 */
	public function setOriginalName($sOriginal)
	{
		$this->sOriginal = $sOriginal;
	}
}
