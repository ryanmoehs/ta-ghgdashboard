<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test login.
     * @group login
     */
    public function testLogin(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->screenshot('debug-login')
                    ->assertPresent('input[name="username"]')
                    ->assertSee('EMisi.')
                    ->assertpath('/login')
                    ->type('username', 'comp1')
                    ->type('password', 'comp1pass')
                    ->press('Log in')
                    ->assertPathIs('/')
                    ->assertSee('Dashboard');
        });
    }
}
