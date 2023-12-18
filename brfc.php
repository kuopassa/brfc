<?php

# BRFC ID generator in PHP language.
# Based on: https://github.com/moneybutton/brfc

declare(strict_types=1);

function brfcID(string $title,string $author,string $version):string {

	$brfcID = array(
		$title,
		$author,
		$version
	);

	$brfcID = array_map(
		'trim',
		$brfcID
	);

	$brfcID = implode(
		'',
		$brfcID
	);

	$brfcID = hash(
		'sha256',
		$brfcID,
		true
	);

	$brfcID = hash(
		'sha256',
		$brfcID,
		true
	);

	$brfcID = strrev($brfcID);
	$brfcID = bin2hex($brfcID);

	return substr(
		$brfcID,
		0,
		12
	);
}

header('Content-Type: text/plain');

const TESTS = array(
	'57dd1f54fc67'=>array(
		'title'=>'BRFC Specifications',
		'author'=>'andy (nChain)',
		'version'=>'1',
	),
	'74524c4d6274'=>array(
		'title'=>'bsvalias Payment Addressing (PayTo Protocol Prefix)',
		'author'=>'andy (nChain)',
		'version'=>'1',
	),
	'0036f9b8860f'=>array(
		'title'=>'bsvalias Integration with Simplified Payment Protocol',
		'author'=>'andy (nChain)',
		'version'=>'1',
	),
);

foreach (TESTS as $expectedResult=>$ids) {

		$testResult = brfcID(
			$ids['title'],
			$ids['author'],
			$ids['version']
		);

		echo "Result:\t\t\t",$testResult;
		echo PHP_EOL;
		echo "Should be:\t\t",$expectedResult;
		echo PHP_EOL;
		echo str_repeat('-',55);
		echo PHP_EOL;
}