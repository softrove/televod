<?php

$I = new ApiTester($scenario);
$I->wantTo('get an empty list');
$I->sendGET('series');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(["success" => false]);
$I->seeResponseContainsJson(["message" => "No Record(s) Found"]);
$seriesList = $I->grabDataFromResponseByJsonPath("$.data.series.*");
\PHPUnit_Framework_Assert::assertEmpty($seriesList);


$I = new ApiTester($scenario);
$I->wantTo('get a single item in list');
$I->haveInDatabase('series', array('id' => 1, 'title' => 'series 1', 'url' => 'http://series1', 'updated' => ''));
$I->sendGET('series');
$I->seeResponseCodeIs(200);
$I->seeResponseIsJson();
$I->seeResponseContainsJson(["success" => true]);
//$I->seeResponseContainsJson(["message" => "No Record(s) Found"]);
$seriesList = $I->grabDataFromResponseByJsonPath("$.data.series.*");
\PHPUnit_Framework_Assert::assertEquals(1, count($seriesList));
$series1 = $seriesList[0];
\PHPUnit_Framework_Assert::assertEquals($series1['id'], 1);

