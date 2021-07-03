<?php

namespace App\DataTables;

use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorDataTable extends DataTable
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
            ->addColumn('profile', function ($query) {
                if($query->profile_picture){
                    $url = asset('storage/'.$query->profile_picture);
                    return '<img src="'.$url.'" height="70px;" width="70px;">';
                }else{
                    return '';
                }
            })
            ->addColumn('country', function ($query) {
                return $query->location->country;
            })
            ->addColumn('state', function ($query) {
                return $query->location->state;
            })
            ->addColumn('city', function ($query) {
                return $query->location->city;
            })
            ->addColumn('longitude', function ($query) {
                return $query->location->long;
            })
            ->addColumn('latitude', function ($query) {
                return $query->location->lat;
            })
            ->addColumn('action', function ($query) {

                $editUrl = URL::to('/admin/admin_vendor/'.$query->id.'/edit');
                $viewUrl = URL::to('/admin/admin_vendor/'.$query->id);

                $button = '<a href="'.$editUrl.'" id="btnEdit" class="btn btn-sm btn-info mr-1 mb-1" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
                $button.= '<button data-id="'.$query->id.'" id="btnDelete" class="btn btn-sm btn-danger mr-1 mb-1" type="submit" title="Delete" ><i class="fa fa-trash"></i> Delete</button>';
                $button.= '<a href="'.$viewUrl.'" id="btnView" class="btn btn-sm btn-warning mr-1 mb-1" title="Show Details"><i class="fa fa-eye"></i> View</a>';

                return $button;
            })
            ->rawColumns(['profile','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Vendor $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Vendor $model)
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
                    ->setTableId('vendor-table')
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
            Column::make('profile')
                ->exportable(false)
                ->printable(false),

            Column::make('first_name'),
            Column::make('last_name'),
            Column::make('email'),
            Column::make('phone'),
            Column::make('country'),
            Column::make('state'),
            Column::make('city'),
            Column::make('longitude'),
            Column::make('latitude'),
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
        return 'Vendor_' . date('YmdHis');
    }
}
