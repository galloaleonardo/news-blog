<!-- Modal DELETE -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                        <span class="icon text-danger">
                            <i class="fas fa-trash-alt"></i>
                            {{ trans('admin.delete') }}
                        </span>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>{{ trans('admin.want_remove_question') }}</p>
                <p>{{ trans('admin.operation_irreversible') }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('admin.no_close') }}</button>
                <form method="POST" id="deleteFormIndex" action="">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">{{ trans('admin.yes_delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
