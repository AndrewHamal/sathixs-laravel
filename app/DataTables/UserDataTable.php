<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->setRowId(function (User $user) {
                return $user->id;
            })
            ->addColumn('role', function(User $user) {
                return $user->role_id == 1 ? 'Admin' : $user->role_id;
            })
            ->addColumn('registered at', function(User $user) {
                return $user->created_at->diffForHumans();
            })
            ->addColumn('action', function (User $user) {
                $button = '<button data-id="'.$user->id.'" id="btnEdit" class="btn btn-sm btn-info mr-1 mb-1" title="Edit"><i class="fa fa-edit"></i> Edit</button>';
                $button.= '<button class="btn btn-sm btn-danger mr-1 mb-1" id="btnDelete" type="submit" title="Delete" data-id="'.$user->id.'"><i class="fa fa-trash"></i> Delete</button>';

                return $button;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('pageLength'),
                    )

            ->scrollX('true')
            ->responsive('true')
            ->lengthMenu([[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('name'),
            Column::make('phone'),
            Column::make('email'),
            Column::make('role'),
            Column::make('registered at'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
