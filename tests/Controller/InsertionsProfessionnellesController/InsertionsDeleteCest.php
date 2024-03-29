<?php

namespace App\Tests\Controller\InsertionsProfessionnellesController;

use App\Factory\InsertionProfessionnelleFactory;
use App\Factory\LocalisationFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ControllerTester;
use Codeception\Util\HttpCode;

class InsertionsDeleteCest
{
    public function form(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $loca = LocalisationFactory::createOne(['entreprise' => $user]);
        $insertion = InsertionProfessionnelleFactory::createOne(['localisation' => $loca, 'titre' => 'infomatique', 'typePro' => 2]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/delete');
        $I->seeResponseCodeIs(HttpCode::OK);
        $I->seeInTitle("Suppression de l'alternance: ".$insertion->getTitre());
        $I->see("Suppression de l'alternance: ".$insertion->getTitre(), 'h1');
    }

    public function accessIsRestrictedToAuthenticatedUsers(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $loca = LocalisationFactory::createOne(['entreprise' => $user]);
        InsertionProfessionnelleFactory::createOne(['localisation' => $loca]);
        $I->amOnPage('/insertions/1/delete');
        $I->seeCurrentUrlEquals('/login');
    }

    public function accessIsRestrictedToAuthors(ControllerTester $I): void
    {
        $user = UserFactory::createOne(['tpUser' => 2, 'isVerified' => true, 'roles' => ['ROLE_COMPANY']]);
        $loca = LocalisationFactory::createOne(['entreprise' => $user]);
        InsertionProfessionnelleFactory::createOne(['localisation' => $loca]);
        $user = UserFactory::createOne(['roles' => ['ROLE_STUDENT']]);
        $user = $user->object();
        $I->amLoggedInAs($user);
        $I->amOnPage('/insertions/1/delete');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
