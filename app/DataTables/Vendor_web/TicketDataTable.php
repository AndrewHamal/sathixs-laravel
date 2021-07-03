<?php

namespace App\DataTables\Vendor_web;

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
                if($query->status ==1)
                {
                    return ' <span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('created_at', function($query) {
                return $query->created_at->diffForHumans();
            })
            ->addColumn('action', function ($query) {

                $editUrl = URL::to('/webvendor/ticket/'.$query->id.'/edit');
                $viewUrl = URL::to('/webvendor/ticket/'.$query->id);
                $activeUrl = URL::to('webvendor/active/ticket/'.$query->id);
                $inactiveUrl = URL::to('webvendor/inactive/ticket/'.$query->id);

                $button = '<a href="'.$editUrl.'" id="btnEdit" class="btn btn-sm btn-info mr-1 mb-1" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
                $button.= '<button data-id="'.$query->id.'" id="btnDelete" class="btn btn-sm btn-danger mr-1 mb-1" type="submit" title="Delete" ><i class="fa fa-trash"></i> Delete</button>';
                $button.= '<a href="'.$viewUrl.'" id="btnView" class="btn btn-sm btn-warning mr-1 mb-1" title="Show Details"><i class="fa fa-eye"></i> View</a>';
                if($query->status == 1)
                {
                    $button.= '<a href="'.$inactiveUrl.'" id="btnInactive" class="btn btn-sm btn-danger mr-1 mb-1" title="Inactive"><i class="fa fa-thumbs-down"></i> Inactive</a>';
                }else{
                    $button.= '<a href="'.$activeUrl.'" id="btnActive" class="btn btn-sm btn-info mr-1 mb-1" title="Active"><i class="fa fa-thumbs-up"></i> Active</a>';
                }
                return $button;
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
        return Ticket::where('vendor_id', auth()->user()->id);
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
            Column::make('name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('subject'),
            Column::make('message'),
            Column::make('status'),
            Column::make('created_at'),
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
        return 'Vendor_Ticket_' . date('YmdHis');
    }
}
