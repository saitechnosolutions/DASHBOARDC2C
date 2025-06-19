<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class CategoryDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn() // Automatically adds S.No column
            ->setRowId('id')
            ->addColumn('category_name', function ($row) {
                return e($row->category_name); // Use e() for escaping output
            })
            ->addColumn('actions', function ($row) {
                return '
                    <button class="btn btn-sm btn-primary edit-category-btn"  
                        data-id="' . $row->id . '" 
                        data-name="' . e($row->category_name) . '" 
                        data-bs-toggle="modal" 
                        data-bs-target="#editcategoryModal">
                        Edit
                    </button>
            
                    <form action="' . url('/category/delete/' . $row->id) . '" method="POST" class="deleteCategoryForm d-inline">
                        ' . csrf_field() . '
                        ' . method_field('POST') . '
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                ';
            })


            ->rawColumns(['actions']);
    }

    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery()->select('id', 'category_name');
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('category-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(0) // Order by first column (S.No)
            ->selectStyleSingle()
            ->addTableClass('table table-bordered table-hover')
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload'),
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('DT_RowIndex')->title('S.No')->searchable(false)->orderable(false),
            Column::make('category_name')->title('Category Name'),
            Column::computed('actions')->title('Actions')->searchable(false)->orderable(false),

        ];
    }

    protected function filename(): string
    {
        return 'Category_' . date('YmdHis');
    }
}