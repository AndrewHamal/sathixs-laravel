<?php

namespace App\DataTables;

use App\Models\Rider\Rider;
use Illuminate\Support\Facades\URL;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RiderDataTable extends DataTable
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
                if($query->profile_photo){
                    $url = asset('storage/'.$query->profile_photo);
                    return '<img src="'.$url.'" height="70px;" width="70px;">';
                }else{
                    return '';
                }
            })
            ->addColumn('gender', function($query) {
                return $query->riderDetail->gender;
            })
            ->addColumn('birth_date', function($query) {
                return $query->riderDetail->date_of_birth;
            })
            ->addColumn('status', function($query) {
                if($query->status ==1)
                {
                    return ' <span class="badge badge-success">Active</span>';
                }else{
                    return '<span class="badge badge-danger">Inactive</span>';
                }
            })
            ->addColumn('action', function ($query) {

                $editUrl = URL::to('admin/rider/'.$query->id.'/edit');
                $viewUrl = URL::to('admin/rider/'.$query->id);
                $activeUrl = URL::to('admin/active/rider/'.$query->id);
                $inactiveUrl = URL::to('admin/inactive/rider/'.$query->id);

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
            ->rawColumns(['profile','status','action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Rider\Rider $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        return Rider::with('riderDetail');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('rider-table')
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
            Column::make('gender'),
            Column::make('birth_date'),
            Column::make('status'),
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
        return 'Rider_' . date('YmdHis');
    }
}
