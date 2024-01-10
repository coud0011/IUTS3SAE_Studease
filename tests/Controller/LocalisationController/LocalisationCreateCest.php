<?php

namespace App\Tests\Controller\LocalisationController;

use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class LocalisationCreateCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/localisation/create');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInTitle("Création d'une localisation");
        $I->see('Créer une localisation', 'h1');
    }
}
