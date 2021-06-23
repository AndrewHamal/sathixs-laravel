<?php

namespace App\DataTables;

use App\Models\Vendor\Package;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PackageDataTable extends DataTable
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
            ->addColumn('category', function ($query) {
                return $query->category->title;
            })
            ->addColumn('vendor', function ($query) {
                $firstName = $query->vendor->first_name;
                $lastName = $query->vendor->last_name;
                $phone = $query->vendor->phone;
                return $firstName.' '.$lastName ;
            })
            ->addColumn('receiver_signature_image', function ($query) {
                if($query->receiver_signature_image){
                    $url = asset('storage/'.$query->receiver_signature_image);
                    return '<img src="'.$url.'" height="70px;" width="70px;">';
                }else{
                    return '';
                }
            })
            ->addColumn('action', function ($query) {

                $editUrl = URL::to('/admin_package/'.$query->id.'/edit');
                $viewUrl = URL::to('admin_package/'.$query->id);

                $button = '<a href="'.$editUrl.'" id="btnEdit" class="btn btn-sm btn-info mr-1 mb-1" title="Edit"><i class="fa fa-edit"></i> Edit</a>';
                $button.= '<button data-id="'.$query->id.'" id="btnDelete" class="btn btn-sm btn-danger mr-1 mb-1" type="submit" title="Delete" ><i class="fa fa-trash"></i> Delete</button>';
                $button.= '<a href="'.$viewUrl.'" id="btnView" class="btn btn-sm btn-warning mr-1 mb-1" title="Show Details"><i class="fa fa-eye"></i> View</a>';

                return $button;
            })
            ->rawColumns(['receiver_signature_image','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Package $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Package $model)
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
                    ->setTableId('package-table')
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

            Column::make('category'),
            Column::make('no_of_package'),
            Column::make('receiver_name'),
            Column::make('receiver_address'),
            Column::make('receiver_phone'),
            Column::make('weight'),
            Column::make('special_instruction'),
            Column::make('vendor'),
            Column::make('product_price'),
            Column::make('tracking_id'),
            Column::make('receiver_signature_name'),
            Column::make('receiver_signature_image')
                ->exportable(false)
                ->printable(false),
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
        return 'Package_' . date('YmdHis');
    }
}
