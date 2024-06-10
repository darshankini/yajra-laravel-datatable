<h1>Yajra Box Laravel Datatable</h1>

We tried to simplify yajra box laravel datatable documentation for easy understanding.

Please download the datatable HTML builder from below link.
https://editor.datatables.net/download/

#install
1. create laravel project
<code>composer create-project laravel/laravel your-project-name</code>

2. Install Yajra datatable package
<code>composer require yajra/laravel-datatables-oracle</code>

3. After installing the package, publish the configuration
<code>php artisan vendor:publish --tag=datatables</code>

4. Create a model and migration for your resepective table eg. users
<code>php artisan make:model User -m</code>

5. Run the migration to create table
<code>php artisan migrate</code>

6. Create a resournce route for your crud operation
<code>Route::resource('users', 'UsersController');</code>

7. Create a controller

8. Create datatable using Laravel Yajra datatable HTML builder and Editor class
php artisan datatables:make UserDataTable
php artisan datatables:editor Users

- it will generate UserDataTable class in the app/Datatables directory.
  open this file and configure your datatables by specifying models,columns and other settings.

9. Create a blade view


Important methods:

to add new column
<code>->addColumn('action', 'action')</code>

edit column
<code>->editColumn('created_at', function (User $user) {
    return $user->created_at->diffForHumans();
})</code>

removed column
<code>->removeColumn('updated_at')</code>

add index columns
<code>->addIndexColumn()</code>

set class to row
<code>->setRowClass('{{ $id % 2 == 0 ? "fw-bold" : "" }}')</code>

set id to row
<code>->setRowId('id')</code>

set row attr
<code>->setRowAttr(['class' => 'fst-italic'])</code>

order column
<code>->orderColumn('action', false)</code>








