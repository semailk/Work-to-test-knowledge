<?php

namespace App\Http\Controllers\Admin;

use App\Models\Author;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;


class AuthorController extends CrudController
{
    use ListOperation;
    use ShowOperation { show as traitShow; }
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;

    public function setup(): void
    {
        $this->crud->setModel('App\Models\Author');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/authors');
        $this->crud->setEntityNameStrings('Афтор', 'Афторы');
    }

    protected function setupListOperation(): void
    {
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation(): void
    {
        $this->crud->setFromDb();
    }

    protected function setupUpdateOperation(): void
    {
        $this->crud->setFromDb();
    }


    public function show($id): object
    {
        $author = Author::query()->find($id)->books()->orderBy('name')->get();
        $content = $this->traitShow($id);
        foreach ($author as $book)
        {
            $this->crud->addColumns([
                $book->name => 'books'
            ]);
        }
        return $content;
    }
}
