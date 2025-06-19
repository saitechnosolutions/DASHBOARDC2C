<?php

namespace App\DataTables;

use App\Models\Painter;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PainterDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->setRowId('id')
            ->addColumn('painter_name', function ($row) {
                return e($row->painter_name); // Use e() for escaping output
            })
            ->addColumn('service_name', function ($row) {
                return e($row->service_name); // Use e() for escaping output
            })
            ->addColumn('day', function ($row) {
                return e($row->day); // Use e() for escaping output
            })
            ->addColumn('date', function ($row) {
                return e($row->date); // Use e() for escaping output
            })
            ->addColumn('time', function ($row) {
                return e($row->time); // Use e() for escaping output
            })
            ->addColumn('room_size', function ($row) {
                return e($row->room_size); // Use e() for escaping output
            })
            ->addColumn('location', function ($row) {
                return e($row->location); // Use e() for escaping output
            })
            ->addColumn('painter_charges', function ($row) {
                return e($row->painter_charges); // Use e() for escaping output
            })
            ->addColumn('customer_name', function ($row) {
                return e($row->customer_name); // Use e() for escaping output
            })
            ->addColumn('customer_email', function ($row) {
                return e($row->customer_email); // Use e() for escaping output
            })
            ->addColumn('customer_phone', function ($row) {
                return e($row->customer_phone); // Use e() for escaping output
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Painter $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('painter-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('S.No')->searchable(false)->orderable(false),
            Column::make('painter_name')->title('painter Name'),
            Column::make('service_name')->title('Service Name'),
            Column::make('day')->title('Day'),
            Column::make('date')->title('Date'),
            Column::make('time')->title('Time'),
            Column::make('room_size')->title('Room Size'),
            Column::make('location')->title('Location'),
            Column::make('painter_charges')->title('Painter Charges'),
            Column::make('customer_name')->title('Customer Name'),
            Column::make('customer_email')->title('Customer Email'),
            Column::make('customer_phone')->title('Customer Phone'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Painter_' . date('YmdHis');
    }
}