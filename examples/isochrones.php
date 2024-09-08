<?php
include __DIR__ . '/../src/autoload.php';

$inst = new \Riverside\Osrm\Isochrones\OpenRouteService();

$inst->setApiKey('{api_key}');

try {
    $response = $inst
        ->setLocations([[8.681495,49.41461],[8.686507,49.41943]])
        ->setRange([300,200])
        ->fetch();
    if ($response->isOK())
    {
        echo '<pre>';
        print_r($response->getFeatures());
        print_r($response->getBbox());
        print_r($response->getMetadata());
        var_dump($response->getType());
        print_r($response->toArray());
    } else {
        echo 'Isochrone not found.';
    }
} catch (\Riverside\Osrm\Exception $e) {
    echo $e->getMessage();
} catch (Exception $e) {
    echo $e->getMessage();
}
