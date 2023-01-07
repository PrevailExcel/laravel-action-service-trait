<?php

namespace PrevailExcel\ActionServiceTrait;

use Illuminate\Support\ServiceProvider;

/** 
 * This file is part of the Laravel Action Service Trait package.
 *
 * @author Prevail Ejimadu <prevailexcellent@gmail.com> (C)
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class ASTServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->commands(MakeAction::class);
        $this->commands(MakeService::class);
        $this->commands(MakeTrait::class);
    }
}