<?php
namespace App\DataTables;

use App\Models\consultant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class consultantDataTable extends DataTable
{
//      * @param QueryBuilder $query Results from query() method.
    
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->setRowId('id')
            ->addColumn('name', fn($row) => e($row->name))
            ->addColumn('email', fn($row) => e($row->email))
            ->addColumn('mobile_number', fn($row) => e($row->mobile_number))
            ->addColumn('consultant_date', fn($row) => e($row->consultant_date))
            ->addColumn('select_color', fn($row) => e($row->select_color))// match with DB column name
            ->addColumn('pin_code', fn($row) => e($row->pin_code))
            ->addColumn('state', fn($row) => e($row->state))
            ->addColumn('distric', fn($row) => e($row->distric));
}

    /**
     * Get the query source of dataTable.
     */
    public function query(Consultant $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('consultant-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                'excel',
                'csv',
                'pdf',
                'print',
                'reset',
                'reload'
            ]);
    }

    /**
     * Get the columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('S.No')->searchable(false)->orderable(false),
            Column::make('name')->title('name'),
            Column::make('email')->title('email'),
            Column::make('mobile_number')->title('mobile_number'),
            Column::make('consultant_date')->title('consultant_date'),
            Column::make('color')->title(' Color'),
            Column::make('pin_code')->title(' pin_code'),
            Column::make('state')->title(' state'),
            Column::make('distric')->title(' distric'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Consultants_' . date('YmdHis');
    }

     
       
      
     
}
