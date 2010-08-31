<?php
/**
 * Mock of the strtotime() builtin
 * Will always use the optional 'now' parameter for relative dates if
 * no timestamp is specified.
 * This allows strtotime to always use a mocked time() function instead
 * of the real system time.
 */
class BuiltinMock_Strtotime_UseTime extends BuiltinMock_Date_UseTime
{
}
?>