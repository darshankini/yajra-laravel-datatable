<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))

            //to add new column
            //you will find action.blade.php file in views
            ->addColumn('action', 'action')


            //edit column
            ->editColumn('created_at', function (User $user) {
                return $user->created_at->diffForHumans();
            })

            //removed column
            ->removeColumn('updated_at')

            //add index columns
            ->addIndexColumn()

            //set class to row
            ->setRowClass('{{ $id % 2 == 0 ? "fw-bold" : "" }}')

            //set id to row
            ->setRowId('id')

            //set row attr
            ->setRowAttr(['class' => 'fst-italic'])

            //order column
            ->orderColumn('action', false)
            
            
            //remove password column
            ->addColumn('password', '');
    }

    /**
     * Get query source of dataTable.
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {
        return $model->newQuery()->select('id','name','email','created_at')->orderBy('id', 'ASC');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('users-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->parameters([
                        // 'searching' => false,
                        'dom'=> "Bfrtip",
                        'select' => [
                            'style' => 'os',
                            'selector' => 'td:first-child',
                        ],
                        'buttons' => [
                            ['extend' => 'create', 'editor' => 'editor'],
                            ['extend' => 'edit', 'editor' => 'editor'],
                            ['extend' => 'remove', 'editor' => 'editor'],
                            ['extend' => 'excel'],
                            ['extend' => 'csv'],
                            ['extend' => 'print']
                        ],
                        
                        // footer column search
                        // 'info' => true,
                        // 'initComplete' => "function () {
                        //     this.api().columns().every(function () {
                        //         var column = this;
                        //         var input = document.createElement(\"input\");
                        //         $(input).appendTo($(column.footer()).empty())
                        //         .on('change', function () {
                        //             column.search($(this).val(), false, false, true).draw();
                        //         });
                        //     });
                        // }"
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            [
                'data' => null,
                'defaultContent' => '',
                'className' => 'select-checkbox',
                'title' => '',
                'orderable' => false,
                'searchable' => false
            ],
            Column::make('id')->data('DT_RowIndex')->orderable(true)->exportable(true),
            Column::make('name'),
            Column::make('email'),
            Column::make('created_at'),
            // Column::make('action')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Users_' . date('YmdHis');
    }
}
