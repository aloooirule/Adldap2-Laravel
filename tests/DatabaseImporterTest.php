<?php

namespace Adldap\Laravel\Tests;

use Adldap\Laravel\Commands\Import;
use Adldap\Laravel\Tests\Models\User;

class DatabaseImporterTest extends DatabaseTestCase
{
    public function test_handle()
    {
        $user = $this->makeLdapUser([
            'cn' => 'John Doe',
            'userprincipalname' => 'jdoe@email.com',
        ]);

        $importer = new Import($user, new User());

        $model = $importer->handle();

        $this->assertEquals($user->getCommonName(), $model->name);
        $this->assertEquals($user->getUserPrincipalName(), $model->email);
        $this->assertFalse($model->exists);
    }
}
