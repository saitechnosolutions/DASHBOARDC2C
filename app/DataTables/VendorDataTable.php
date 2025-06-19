<?php

namespace App\DataTables;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorDataTable extends DataTable
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
            ->addColumn('vendor_name', function ($row) {
                return e($row->vendor_name); // Use e() for escaping output
            })
            ->addColumn('vendor_email', function ($row) {
                return e($row->vendor_email); // Use e() for escaping output
            })
            ->addColumn('contact_name', function ($row) {
                return e($row->contact_name); // Use e() for escaping output
            })
            ->addColumn('contact_phone', function ($row) {
                return e($row->contact_phone); // Use e() for escaping output
            })
            ->addColumn('business_type', function ($row) {
                return e($row->business_type); // Use e() for escaping output
            })
            ->addColumn('gst_number', function ($row) {
                return e($row->gst_number); // Use e() for escaping output
            })
            ->addColumn('vendor_address', function ($row) {
                return e($row->vendor_address); // Use e() for escaping output
            })
            ->addColumn('vendor_state', function ($row) {
                return e($row->vendor_state); // Use e() for escaping output
            })
            ->addColumn('vendor_district', function ($row) {
                return e($row->vendor_district); // Use e() for escaping output
            })
            ->addColumn('vendor_pincode', function ($row) {
                return e($row->vendor_pincode); // Use e() for escaping output
            })
            ->addColumn('vendor_bank_name', function ($row) {
                return e($row->vendor_bank_name); // Use e() for escaping output
            })
            ->addColumn('vendor_account_name', function ($row) {
                return e($row->vendor_account_name); // Use e() for escaping output
            })
            ->addColumn('vendor_account_number', function ($row) {
                return e($row->vendor_account_number); // Use e() for escaping output
            })
            ->addColumn('vendor_ifsc_number', function ($row) {
                return e($row->vendor_ifsc_number); // Use e() for escaping output
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Vendor $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendor-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->responsive(true)
                    ->addTableClass('table table-bordered table-hover nowrap')
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
            Column::make('vendor_name')->title('Vendor Name'),
            Column::make('vendor_email')->title('Vendor Email'),
            Column::make('contact_name')->title('Contact Name'),
            Column::make('contact_phone')->title('Contact Phone'),
            Column::make('business_type')->title('Business Type'),
            Column::make('gst_number')->title('GST'),
            Column::make('vendor_address')->title('Address'),
            Column::make('vendor_state')->title('State'),
            Column::make('vendor_district')->title('District'),
            Column::make('vendor_pincode')->title('Pincode'),
            Column::make('vendor_bank_name')->title('Bank Name'),
            Column::make('vendor_account_name')->title('Account Holder Name'),
            Column::make('vendor_account_number')->title('Account Number'),
            Column::make('vendor_ifsc_number')->title('IFSC Code'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Vendor_' . date('YmdHis');
    }
}