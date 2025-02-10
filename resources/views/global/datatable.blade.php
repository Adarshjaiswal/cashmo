@push('scripts')
    {{ $dataTable->scripts() }}
@endpush
<x-app-layout :assets="$assets ?? []">
<div>
   <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">{{ $pageTitle ?? 'List'}}</h4>
               </div>
                <!-- <div class="card-action">
                {!! $headerAction ?? 'No Action Available' !!}
                </div> -->
                <div class="card-action">
                   <a href="{{ route('users.create')}}" class="btn btn-sm btn-primary">Add User</a>
               </div>
            </div>
            <div class="card-body px-0">
               <div class="table-responsive">
                    {{ $dataTable->table(['class' => 'table text-center table-striped w-100'],true) }}
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Add Funds Modal -->
<div class="modal fade" id="addFundsModal" tabindex="-1" aria-labelledby="addFundsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFundsModalLabel">Add Funds</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addFundsForm">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="user_id" id="modalUserId">
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Funds</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Add Funds Modal -->
<div class="modal fade" id="addFundsModal" tabindex="-1" aria-labelledby="addFundsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFundsModalLabel">Add Funds</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="addFundsForm">
        @csrf
        <div class="modal-body">
          <input type="hidden" name="user_id" id="modalUserId">
          <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" class="form-control" id="amount" name="amount" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Add Funds</button>
        </div>
      </form>
    </div>
  </div>
</div>

</x-app-layout>
<script type="text/javascript">
   document.addEventListener('DOMContentLoaded', function () {
    const addFundsModal = document.getElementById('addFundsModal');
    addFundsModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const userId = button.getAttribute('data-user-id'); // Extract user ID

        // Update the modal's hidden input field
        const modalUserIdInput = addFundsModal.querySelector('#modalUserId');
        modalUserIdInput.value = userId;
    });

    // Handle form submission
    const addFundsForm = document.getElementById('addFundsForm');
    addFundsForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        fetch('{{ route('users.addFunds') }}', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Funds added successfully!');
                location.reload();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred.');
        });
    });
});


</script>