<div class="modal fade" id="modal-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title">{!! $title or 'Modal Title' !!}</h4>
            </div>

            <div class="modal-body">
                <p class="modal-message">{!! $message or 'Write your modal message here!' !!}</p>
            </div>

            <div class="modal-footer">
                {!! Form::open(['url' => '', 'class' => 'modal-action', 'method' => 'delete']) !!}
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('show.bs.modal', '#modal-delete', function(e) {
        $('.modal-title', this).text($(e.relatedTarget).data('title'));
        $('.modal-message', this).text($(e.relatedTarget).data('message'));
        $('.modal-action', this).attr('action', $(e.relatedTarget).data('action'));
    });
</script>