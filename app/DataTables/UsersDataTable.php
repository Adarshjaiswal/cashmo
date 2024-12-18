<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
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
            ->editColumn('full_name', function($query) {
                return $query->first_name . ' ' . $query->last_name;
            })
            ->editColumn('status', function($query) {
                $statusClass = 'warning'; 
                switch ($query->status) {
                    case 'active':
                        $statusClass = 'primary';
                        break;
                    case 'inactive':
                        $statusClass = 'danger';
                        break;
                    case 'banned':
                        $statusClass = 'dark';
                        break;
                }
                return '<span class="text-capitalize badge bg-' . $statusClass . '">' . $query->status . '</span>';
            })
            ->editColumn('created_at', function($query) {
                return date('Y/m/d', strtotime($query->created_at));
            })
            ->filterColumn('full_name', function($query, $keyword) {
                $sql = "CONCAT(users.first_name, ' ', users.last_name)  like ?";
                return $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->addColumn('action', function($query) {
                 // Add the "Add Funds" button with a unique ID
                 $addFundsButton = '<button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#addFundsModal" data-user-id="'.$query->id.'"><i class="bi bi-plus"></i> Add Funds</button>';
            
                $editUrl = route('users.edit', $query->id);
                $statusButton = '';
            
                if ($query->hasRole('user') && $query->status === 'pending') {
                    $statusButton = '<a href="'.route('users.change-status', $query->id).'" class="btn btn-sm btn-success">Activate</a>';
                } else {
                    $statusButton = '<a href="'.route('users.change-status', $query->id).'" class="btn btn-sm btn-danger">Deactivate</a>';
                }
            
                $editButton = '<a href="'.$editUrl.'" class="btn btn-sm btn-primary">Edit</a>';
                
               
                return $editButton . ' ' . $statusButton . ' ' . $addFundsButton;
            })
            
            ->rawColumns(['action', 'status']);
           

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $model = User::query();
        return $this->applyScopes($model);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('dataTable')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('<"row align-items-center"<"col-md-2" l><"col-md-6" B><"col-md-4"f>><"table-responsive my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">')
                    ->parameters([
                        "processing" => true,
                        "autoWidth" => false,
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            ['data' => 'full_name', 'name' => 'full_name', 'title' => 'Full Name', 'orderable' => false],
            ['data' => 'phone_number', 'name' => 'phone_number', 'title' => 'Phone Number'],
            ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
            ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Join Date'],
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->searchable(false)
                  ->width(60)
                  ->addClass('text-center hide-search'),
        ];
    }
}
