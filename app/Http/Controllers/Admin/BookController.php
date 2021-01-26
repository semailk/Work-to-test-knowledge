<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
use Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;

class BookController extends CrudController
{
    use ListOperation;
    use ShowOperation {show as traitShow;}
    use CreateOperation;
    use UpdateOperation;
    use DeleteOperation;

    public function setup(): void
    {
        $this->crud->setModel('App\Models\Book');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/books');
        $this->crud->setEntityNameStrings('Книга', 'Книги');
    }

    protected function setupListOperation(): void
    {
        $this->crud->setFromDb();
    }


    protected function setupCreateOperation(): void
    {
        $this->crud->setFromDb();
        $this->crud->addField(
            [
                'label'     => "Authors",
                'type'      => 'select2_multiple',
                'name'      => 'authors',
                'entity'    => 'authors',
                'model'     => "App\Models\Author",
                'attribute' => 'name',
                'options'   => (function ($query) {
                    return $query->get();
                }),
            ]
        );
    }

    protected function setupUpdateOperation(): void
    {
        $this->setupCreateOperation();
    }

    public function show($id): object
    {
        $book = Book::query()->find($id)->authors()->orderBy('name')->get();
        $content = $this->traitShow($id);
        foreach ($book as $authors)
        {
            $this->crud->addColumns([
                $authors->name => 'Authors'
            ]);
        }
        return $content;
    }
}
