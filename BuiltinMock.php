<?php
/**
 * Encapsulates and controls mocking of PHP builtin methods.
 *
 * This requires the APD extension to be installed.
 *
 * Example usage:
 * $sOriginalFunction = BuiltinMock::override('time', new BuiltinMock_Time_SomeOverride());
 * $iTimeMock = time();               // returns the value of the time() mock
 * $iTimeOrig = $sOriginalFunction(); // returns the value of the builtin time()
 *
 * BuiltinMock::restore('time');
 * $iTime = time();                   // returns the value of the builtin time()
 */
class BuiltinMock
{
	/**
	 * @var array
	 */
	protected static $aOverrides = array();

	/////////////////////////////////////////////////////////////////////////////
	// STATIC //////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	/**
	 * Call the overriden function
	 *
	 * @param string $sFunction    required=true
	 * @param array  $aArgs        required=true
	 * @return mixed 
	 */
	public static function callOverride($sFunction, $aArgs)
	{
		return call_user_func_array(array(self::$aOverrides[$sFunction], 'mock'), array($aArgs));
	}

	/**
	 * Return the renamed version of a function
	 *
	 * @param string $sFunction    required=true
	 * @return string
	 */
	public static function getRenamedFunction($sFunction)
	{
		return "__original_{$sFunction}";
	}

	/**
	 * Override a given function with a mock
	 *
	 * @param string $sFunction     required=true
	 * @param object $oOverrider    required=true
	 * @return string name by which the original mocked function can be called
	 */
	public static function override($sFunction, $oOverrider)
	{
		$sDefinition = <<<DEFINITION
\$aArgs = func_get_args();
return call_user_func_array(array('BuiltinMock', 'callOverride'), array('$sFunction', \$aArgs));
DEFINITION;

		self::restore($sFunction);

		$sRenamedFunction = self::getRenamedFunction($sFunction);
		rename_function($sFunction, $sRenamedFunction);
		override_function($sFunction, '', $sDefinition);
		rename_function("__overridden__", uniqid("__overridden__"));

		$oOverrider->setOriginalName($sRenamedFunction);
		self::$aOverrides[$sFunction] = $oOverrider;

		return $sRenamedFunction;
	}

	/**
	 * Restore an overriden function to its builtin state
	 *
	 * @param string $sFunction    required=true
	 */
	public static function restore($sFunction)
	{
		$sRenamedFunction = self::getRenamedFunction($sFunction);
		if (function_exists($sRenamedFunction)) {
			rename_function($sFunction, uniqid($sFunction));
			rename_function($sRenamedFunction, $sFunction);
		}
		unset(self::$aOverrides[$sFunction]);
	}
}
?>
