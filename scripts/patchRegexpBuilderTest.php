#!/usr/bin/php
<?php

namespace s9e\TextFormatter\Tests;

class Test {}

function _array(array $arr)
{
	$i = -1;

	$php = 'array(';
	foreach ($arr as $k => $v)
	{
		if (++$i)
		{
			$php .= ', ';
		}

		if (!is_numeric($k))
		{
			$php .= var_export($k, true) . ' => ';
		}

		$php .= (is_array($v)) ? _array($v) : var_export($v, true);
	}

	$php .= ')';

	return $php;
}


include __DIR__ . '/../tests/Configurator/Helpers/RegexpBuilderTest.php';

$test = new Configurator\Helpers\RegexpBuilderTest;

$php = '';
foreach ($test->getWordsLists() as $k => $case)
{
	$regexp   = var_export($case[0], true);
	$wordlist = _array($case[1]);

	$php .= "\n\t/**\n\t* @testdox fromList([" . substr($wordlist, 6, -1) . "]";

	if (isset($case[2]))
	{
		$options = strtr(json_encode($case[2]), array(
			'{' => '[',
			'}' => ']',
			',' => ', ',
			':' => ' => '
		));

		$php .= ', ' . $options . '';
	}

	$php .= ") returns " . $regexp . "\n\t*/\n\tpublic function test_" . strtoupper(dechex(crc32(serialize($case)))) . "()\n\t{\n\t\t\$this->fromListTestCase(" . $k . ");\n\t}\n";
}

$filepath = __DIR__ . '/../tests/Configurator/Helpers/RegexpBuilderTest.php';
$file = file_get_contents($filepath);

$startComment = '// Start of content generated by ../../../scripts/patchRegexpBuilderTest.php';
$endComment = "\t// End of content generated by ../../../scripts/patchRegexpBuilderTest.php";

$file = substr($file, 0, strpos($file, $startComment) + strlen($startComment))
      . $php
      . substr($file, strpos($file, $endComment));

file_put_contents($filepath, $file);

die("Done.\n");