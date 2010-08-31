<?php
/**
 * Mock of the mktime() builtin
 * Will always fill in all optional params with  the current time() values if
 * param is not specified.
 * This allows mktime() to always use a mocked time() function instead
 * of the real system time.
 */
class BuiltinMock_Mktime_UseTime extends BuiltinMock_Function
{
	/////////////////////////////////////////////////////////////////////////////
	// PUBLIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Return a timestamp built from the params
	 *
	 * @param integer $iHour      if not given, will use date('H', time()) required=false
	 * @param integer $iMinute    if not given, will use date('i', time()) required=false
	 * @param integer $iSecond    if not given, will use date('s', time()) required=false
	 * @param integer $iMonth     if not given, will use date('n', time()) required=false
	 * @param integer $iDay       if not given, will use date('j', time()) required=false
	 * @param integer $iYear      if not given, will use date('Y', time()) required=false
	 * @return integer
	 */
	public function mock($aArgs)
	{
		$aFormats = array('H', 'i', 's', 'n', 'j', 'Y');
		foreach ($aFormats as $iArg => $sFormat) {
			$aArgs[$iArg] = (isset($aArgs[$iArg])) ? $aArgs[$iArg] : date($sFormat, time());
		}

		return $this->callOriginal($aArgs);
	}
}
?>
