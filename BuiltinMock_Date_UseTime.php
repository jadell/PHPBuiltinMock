<?php
/**
 * Mock of the date() builtin
 * Will always use the optional timestamp parameter if
 * no timestamp is specified.
 * This allows date to always use a mocked time() function instead
 * of the real system time.
 */
class BuiltinMock_Date_UseTime extends BuiltinMock_Function
{
	/////////////////////////////////////////////////////////////////////////////
	// PUBLIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Return a formatted date string always using the optional timestamp parameter
	 *
	 * @param string  $sFormat       required=true
	 * @param integer $iTimestamp    if not given, will use time() required=false
	 * @return string
	 */
	public function mock($aArgs)
	{
		$aArgs[1] = (isset($aArgs[1])) ? $aArgs[1] : time();

		return $this->callOriginal($aArgs);
	}
}
?>
