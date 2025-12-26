<div class="modal fade" id="modalDestroyFaq{{ $item->id }}" tabindex="-1" role="dialog"
  aria-labelledby="modalDestroyFaqLabel{{ $item->id }}" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">

      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title">
          <i class="fas fa-exclamation-triangle mr-2"></i>Hapus FAQ
        </h5>
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">

        <div class="row mb-1">
          <div class="col-5 font-weight-bold">Pertanyaan:</div>
          <div class="col-7">: {{ $item->question }}</div>
        </div>

        <div class="row mb-1">
          <div class="col-5 font-weight-bold">Jawaban:</div>
          <div class="col-7">: {{ $item->answer }}</div>
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">
          <i class="fas fa-times mr-1"></i> Batal
        </button>

        <form action="{{ route('faqDestroy', $item->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-danger btn-sm">
            <i class="fas fa-trash-alt"></i> Hapus
          </button>
        </form>
      </div>

    </div>
  </div>
</div>
