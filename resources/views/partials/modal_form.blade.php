<div class="modal fade" id="modal-form" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    <i class="fa fa-times"></i>
                </button>
                <h4 class="modal-title">{!! $title or 'Modal Title' !!}</h4>
            </div>

            <div class="modal-body">
                {!! $content or 'Modal Content'  !!}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary" onclick="$('#modal-form form').submit();">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on('show.bs.modal', '#modal-form', function(e) {
        $('.modal-body', this).html('<h1 class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i></h1>');

        $('.modal-title', this).text($(e.relatedTarget).data('title'));
        $('.modal-message', this).text($(e.relatedTarget).data('message'));
            axios.get($(e.relatedTarget).data('action'))
            .then(function (response) {
                $('.modal-body', this).html(response.data);
            }.bind(this))
    });

    $(document).on('hiden.bs.modal', '#modal-form', function(e) {
        $('.modal-body', this).html('<h1 class="text-center"><i class="fa fa-spinner fa-spin fa-fw"></i></h1>');
    });

    $(document).on('submit', '#modal-form form', function(e) {
        e.preventDefault();
        vm.submit(e);
    });
</script>