<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
// use Backpack\NewsCRUD\app\Http\Requests\ArtWorkRequest;
use App\Http\Requests\ArtWorkRequest;

class ArtWorkController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ReorderOperation;
    // use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;

    public function setup()
    {
        // CRUD::setModel("Backpack\NewsCRUD\app\Models\Category");
        // CRUD::setRoute(config('backpack.base.route_prefix', 'admin') . '/category');
        // CRUD::setEntityNameStrings('category', 'categories');

        CRUD::setModel(\App\Models\ArtWork::class);
        CRUD::setRoute(config('backpack.base.route_prefix', 'admin') . '/artwork');
        CRUD::setEntityNameStrings('artwork', 'ArtWork');
    }

    protected function setupListOperation()
    {
        CRUD::addColumn([
            // 1-n relationship
            'label'          => 'Category', // Table column heading
            'type'           => 'select',
            'name'           => 'category_id', // the column that contains the ID of that connected entity;
            'entity'         => 'category', // the method that defines the relationship in your Model
            'attribute'      => 'name', // foreign key attribute that is shown to user
            'visibleInTable' => true,
            'visibleInModal' => false,
        ]);
        // CRUD::addColumn('name');
        // CRUD::addColumn('slug');
        // CRUD::addColumn('parent');
        // CRUD::addColumn([   // select_multiple: n-n relationship (with pivot table)
        //     'label'     => 'Articles', // Table column heading
        //     'type'      => 'relationship_count',
        //     'name'      => 'articles', // the method that defines the relationship in your Model
        //     'wrapper'   => [
        //         'href' => function ($crud, $column, $entry, $related_key) {
        //             return backpack_url('article?category_id='.$entry->getKey());
        //         },
        //     ],
        // ]);
    }

    protected function setupShowOperation()
    {
        $this->setupListOperation();

        CRUD::addColumn('created_at');
        CRUD::addColumn('updated_at');
    }

    protected function setupCreateOperation()
    {
        CRUD::setValidation(ArtWorkRequest::class);

        
        CRUD::addField([  // Select2
            'label'     => 'Category',
            'type'      => 'select2',
            'name'      => 'category_id', // the db column for the foreign key
            'entity'    => 'category', // the method that defines the relationship in your Model
            'attribute' => 'name', // foreign key attribute that is shown to user
            // 'wrapperAttributes' => [
            //     'class' => 'form-group col-md-6'
            //   ], // extra HTML attributes for the field wrapper - mostly for resizing fields
            // 'tab' => 'Basic Info',
        ]);
        // CRUD::addField([
        //     'label' => 'Parent',
        //     'type' => 'select',
        //     'name' => 'parent_id',
        //     'entity' => 'parent',
        //     'attribute' => 'name',
        // ]);
        CRUD::addField([
            'name'  => 'photos',
            'label' => 'Photos ',
            'type'  => 'upload_multiple',
            'class'  => 'backstrap-file',
            'upload'    => true
            // 'tab'   => 'Texts',
        ]);

        
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

   
}
