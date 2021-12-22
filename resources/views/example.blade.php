@extends('app')

@section('content')

    <form class="card my-5 mx-auto px-3 py-3 shadow" style="max-width: 350px;" id="form">

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="form-name" name="name" placeholder="Введите имя...">
            <label for="form-name">Введите имя</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="form-phone" name="phone" placeholder="Введите номер...">
            <label for="form-phone">Телефон</label>
        </div>
        <div class="form-floating mb-3">
            <textarea class="form-control" id="form-comment" name="comment" rows="5" style="height: 150px"
                placeholder="Комментарий"></textarea>
            <label for="form-comment">Комментарий</label>
        </div>

        <button class="btn btn-success" type="button" onclick="send();">Отправить</button>

        @csrf

        <div class="alert alert-danger mt-3 mb-0 py-2" style="display: none;" id="error"></div>

    </form>

    <pre id="response" class="mx-auto my-3 bg-gray p-1 rounded" style="font-size: 80%; max-width: 1000px; background: var(--bs-gray-300); display: none;"></pre>

@endsection

@section('script')

    <script>
        function send() {
            let formdata = {
                name: $('#form-name').val(),
                phone: $('#form-phone').val(),
                comment: $('#form-comment').val(),
                _search: window.location.search || null,
            };

            $('#form').append(`<div style="display: flex; justify-content: center; align-items: center; position: absolute; background: rgba(255,255,255,.5); top: 5px; left: 5px; right: 5px; bottom: 5px;" id="loading">
                <div class="spinner-grow" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>`);

            $.ajax({
                url: "/itcpp/sendrequest",
                data: formdata,
                type: "POST",
                dataType: "JSON",
                success: json => {
                    console.log(json);
                    $('#error').hide();
                    $('#response').show().text(JSON.stringify(json, null, 4));
                },
                error: error => {
                    console.log(error);
                    $('#error').show().text(error.responseJSON && error.responseJSON.message);
                    $('#response').show().text(error.responseText);
                },
                complete: () => {
                    $('#loading').remove();
                }
            });
        }
    </script>

@endsection
