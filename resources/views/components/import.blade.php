<div class="modal fade" id="mediumModal" tabindex="-1" role="dialog" aria-labelledby="mediumModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediumModalLabel">Импорт списка участников</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('participant.import') }}" method="post" enctype="multipart/form-data" class="import-form">
                    {{ csrf_field() }}
                    <label for="importFile">Файл:</label>
                    <input id="importFile" type="file" name="import" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Отменить</button>
                <button type="button" class="btn btn-primary" onclick="document.querySelector('.import-form').submit()">Импортировать</button>
            </div>
        </div>
    </div>
</div>