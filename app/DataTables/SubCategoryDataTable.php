<?php

namespace App\DataTables;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SubCategoryDataTable extends DataTable
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
            ->addColumn('category_display_name', function ($row) {
                return e($row->category_display); // Use e() for escaping output
            })
            ->addColumn('subcategory_name', function ($row) {
                return e($row->subcategory_name); // Use e() for escaping output
            })
            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-sm btn-primary edit-subcategory-btn"  
                        data-id="' . $row->id . '" 
                        data-name="' . e($row->subcategory_name) . '" 
                        data-catname="' . e($row->category_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editsubcategoryModal">
                        Edit
                    </button>
            
                    <button class="btn btn-sm btn-danger delete-subcategory-btn"  
                        data-id="' . $row->id . '" 
                        data-name="' . e($row->subcategory_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        Delete
                    </button>
                ';
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(SubCategory $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('subcategory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
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
            Column::make('category_display_name')->title('Category Name')->searchable(true),
            Column::make('subcategory_name')->title('SubCategory Name')->searchable(true),
            Column::make('actions')->title('Actions')
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'SubCategory_' . date('YmdHis');
    }
}