<div class="modal fade" id="deleteModal{{ $ticket->id }}" tabindex="-1"
    aria-labelledby="deleteModalLabel{{ $ticket->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4" style="border-radius: 12px;">

            {{-- Warning Icon --}}
            <div class="mx-auto mb-3"
                style="width: 60px; height: 60px; background-color: #FFF4E5; border: 2px solid #F1B44C; border-radius: 50%;">
                <div class="d-flex align-items-center justify-content-center h-100">
                    <i class="bi bi-exclamation-lg text-warning" style="font-size: 2rem;"></i>
                </div>
            </div>

            {{-- Title --}}
            <h5 class="fw-bold mb-2">Are you sure you want to delete this ticket?</h5>

            {{-- Buttons --}}
            <div class="d-flex justify-content-center gap-3">
                <form method="POST" action="{{ route('admin.ticket.destroy', $ticket->id) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-success px-4">
                        Yes
                    </button>
                </form>

                <button type="button" class="btn btn-danger px-4" data-bs-dismiss="modal">
                    Cancel
                </button>
            </div>

        </div>
    </div>
</div>
