<x-app-layout :assets="$assets ?? []">
    <div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                   <div class="card-header d-flex justify-content-between">
                      <div class="header-title">
                         <h4 class="card-title">Queries</h4>
                      </div>
                   </div>
                   <div class="card-body">
                      <div class="table-responsive">
                         <table id="datatable" class="table" data-toggle="data-table">
                            <thead>
                               <tr>
                                  <th>ID</th>
                                  <th>USER NAME</th>
                                  <th>QUERY</th>
                                  <th>RESPONSE</th>
                                  <th>STATUS</th>
                                  <th>ACTION</th>
                               </tr>
                            </thead>
                            <tbody></tbody>
                         </table>
                      </div>
                   </div>
                </div>
             </div>
        </div>
    </div>

    <!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Add Admin Response</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="responseForm">
            <div class="form-group">
              <label for="adminResponse">Admin Response:</label>
              <textarea class="form-control" id="adminResponse" rows="3" required></textarea>
            </div>
            <input type="hidden" id="queryId">
            <button type="submit" class="btn btn-primary">Submit Response</button>
          </form>
        </div>
      </div>
    </div>
  </div>

</x-app-layout>

<script>
function fetchWalletDetails(){
    if ($.fn.DataTable.isDataTable('#datatable')) {
        $('#datatable').DataTable().destroy();
    }

    $('#datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("AllQuery.data") }}',
            type: 'GET',
        },
        columns: [
            { data: 'id', name: 'id' },
            {
                data: 'user_name',
                name: 'user_name',
                render: function(data, type, row) {
                    return `${data} (${row.username})`;
                }
            },
            { data: 'query', name: 'query' },  // Query column
            { data: 'admin_response', name: 'admin_response' },  // Admin response column
            { data: 'status', name: 'status' },  // Status column
            {
                data: null,
                name: 'action',
                render: function(data, type, row) {
                    if (row.status === 'Pending') {
                        return `<button class="btn btn-sm btn-primary btn-edit" data-id="${row.id}" data-query="${row.query}" data-response="${row.admin_response}">Edit</button>`;
                    } else {
                        return '';
                    }
                },
                orderable: false,
                searchable: false
            }
        ],
        columnDefs: [
            {
                targets: 1,
                width: '30%',
                className: 'text-wrap'
            },
            {
                targets: 2,
                width: '30%',
                className: 'text-wrap'
            },
            {
                targets: 4,
                width: '20%'
            }
        ]
    });
}

$(document).ready(function() {
    fetchWalletDetails();

    // Open modal on Edit button click
    $(document).on('click', '.btn-edit', function() {
        const queryId = $(this).data('id');
        const adminResponse = $(this).data('response');

        $('#queryId').val(queryId);
        $('#adminResponse').val(adminResponse);

        $('#editModal').modal('show');
    });

    // Handle modal form submission for admin response
    $('#responseForm').submit(function(e) {
        e.preventDefault();

        const queryId = $('#queryId').val();
        const adminResponse = $('#adminResponse').val();

        $.ajax({
            url: '{{ route("update.admin.response") }}',  // Your route for updating the admin response
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                query_id: queryId,
                admin_response: adminResponse
            },
            success: function(response) {
                if (response.success) {
                    Swal.fire('Success', 'Response added successfully', 'success');
                    $('#editModal').modal('hide');
                    fetchWalletDetails();  // Refresh the DataTable
                } else {
                    Swal.fire('Error', 'Something went wrong', 'error');
                }
            },
            error: function() {
                Swal.fire('Error', 'Failed to submit response', 'error');
            }
        });
    });
});

</script>
