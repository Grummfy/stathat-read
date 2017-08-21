<?php

use mageekguy\atoum\reports;
use mageekguy\atoum\reports\coverage;
use mageekguy\atoum\writers\std;
use mageekguy\atoum\report\fields\runner\result\logo;

//
//  config of tests
//

// branch coverage
$script->enableBranchAndPathCoverage();

$runner->addTestsFromDirectory(__DIR__ . '/tests/units');

//
// Reports
//
$report = $script->addDefaultReport();

$extension = new reports\extension($script);
$extension->addToRunner($runner);

// html report
$coverage = new coverage\html();
$coverage->addWriter(new std\out());
$coverage->setOutPutDirectory(__DIR__ . '/tests/reports/unit/');
$runner->addReport($coverage);

// telemetry
$telemetry = new reports\telemetry();
$telemetry->addWriter(new std\out());
$telemetry->readProjectNameFromComposerJson(__DIR__ . '/composer.json');
$runner->addReport($telemetry);

// logo, because I like it!
$report->addField(new logo());
