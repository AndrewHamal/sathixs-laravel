<?php

namespace App\DataTables;

use App\Models\Vendor\Ticket;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class TicketDataTable extends DataTable
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
            ->setRowId(function ($query) {
                return $query->id;
            })
            ->addColumn('status', function($query) {
                if($query->status == 1)
                {
                    return '<span class="badge badge-danger">Closed</span>';
                }
            })
            ->addColumn('created_at', function($query) {
                return $query->created_at->diffForHumans();
            })

            ->rawColumns(['status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vendor\Ticket $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ticket $model)
    {
        return Ticket::where('status', 1);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('vendor_ticket-table')
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
            Column::make('email'),
            Column::make('phone'),
            Column::make('message'),
            Column::make('status'),
            Column::make('created_at')
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
        return 'Vendor_Ticket_' . date('YmdHis');
    }
}
