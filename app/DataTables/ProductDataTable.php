<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() // Automatically adds S.No column
            ->setRowId('id')
            ->addColumn('product_cate_name', function ($row) {
                return e($row->cate_name); // Use e() for escaping output
            })
            ->addColumn('product_subcate_name', function ($row) {
                return e($row->subcate_name); // Use e() for escaping output
            })
            ->addColumn('product_name', function ($row) {
                return e($row->product_name); // Use e() for escaping output
            })
            ->addColumn('product_mrp_price', function ($row) {
                return e($row->product_mrp_price); // Use e() for escaping output
            })
            ->addColumn('product_spec', function ($row) {
                return e($row->product_spec); // Use e() for escaping output
            })
            ->addColumn('product_desc', function ($row) {
                return e($row->product_description); // Use e() for escaping output
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('product-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->addTableClass('table table-bordered table-hover')
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
            Column::make('product_cate_name')->title('Category Name'),
            Column::make('product_subcate_name')->title('SubCategory Name'),
            Column::make('product_name')->title('Product Name'),
            Column::make('product_mrp_price')->title('Price'),
            Column::make('product_desc')->title('Description'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Product_' . date('YmdHis');
    }
}