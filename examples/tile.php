<?php
include __DIR__ . '/../src/autoload.php';

$tile = new \Riverside\Osrm\Service\Tile();

try {
	$response = $tile
        ->setProfile('car')
        ->fetch('tile(1310,3166,13)');

	if ($response->isOK())
    {
		echo '<pre>';
		echo strlen($response->getResponse());
	} else {
		echo 'Tile not found.';
	}

} catch (\Riverside\Osrm\Exception $e) {
	echo $e->getMessage();
} catch (Exception $e) {
	echo $e->getMessage();
}
