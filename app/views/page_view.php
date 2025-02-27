<body class="bg-secondary">

<div class="container my-5">
    <!-- сообщение -->
    <div class="card mb-4">
        <h5 class="text-success" id="acceptMes" style="text-align: center;">Сообщение успешно обновлено!</h5>
        <h5 class="text-danger" id="errorMes" style="text-align: center;">Ошибка сохранения в БД</h5>
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Сообщение</h5>
            <div class="d-flex justify-content-end">
                <button id="editBtn" class="btn btn-secondary btn-sm">Редактировать</button>
            </div>
            <div id="editForm" class="mt-3" style="display: none;">
                <textarea class="form-control mb-2" id="editText"></textarea>
                <div class="d-flex justify-content-end gap-2">
                    <button class="btn btn-sm btn-success" id="saveBtn">Сохранить</button>
                    <button class="btn btn-sm btn-secondary" id="cancelBtn">Отмена</button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p class="card-text" id="mes"></p>
        </div>
    </div>

    <?php if ($data['errors']): ?>
        <h5 class="center text-danger">
            <?php echo $data['errors'][0]; ?>
        </h5>
    <?php endif; ?>

    <!-- Комментарии -->
    <div class="card">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Комментарии</h5>
        </div>
        <div class="card-body">
            <!-- Список комментариев -->
            <ul class="list-group list-group-flush" id="comments-list"></ul>
        </div>

        <!-- Форма для добавления комментария -->
        <div class="card-footer">
            <h6 class="mb-3">Добавить комментарий</h6>
            <form enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="commentText" class="form-label">Комментарий (не менее 5 символов)</label>
                    <textarea name="commentText" class="form-control" rows="3" placeholder="Введите комментарий" minlength="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="action">Отправить</button>
            </form>
        </div>
    </div>

<div class="container mt-5 col-3">
    <div class="row">
        <a href="/" class="btn btn-primary text-dark" role="button"><b>&laquo;<b>Назад на главную</b></a>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {

        $('#acceptMes').hide();                         // при начальной отрисовке страницы прячем сообщение об успешном сохранении сообщения
        $('#errorMes').hide();                         // при начальной отрисовке страницы прячем сообщение об ошибке


        var id = <?php echo $data['id']; ?>;            // id сообщения для запроса через AJAX
        var originalText = '';                          // переменная для хранения исходного текста сообщения

        var loadMessages = function () {
            var result;
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '/app/ajax.php',
                data: {
                    act: "getMesById",             // метод получит сообщение по id
                    id: id
                },
                success: function (data) {
                    result = data.text_;
                    const messageElement = document.getElementById('mes');
                    messageElement.textContent = result;
                    originalText = result;
                },
                // complete: function () { setTimeout(callback, 5000);  }
            });

        }

        // загружаем и выводим сообщение
        loadMessages();
        // загружаем и выводим комметарии
        Load_comments(id);

        // обработчик нажатия на кнопку "Редактировать"
        $('#editBtn').click(function () {
            // скрываем текст и кнопку редактирования
            $('#mes').hide();
            $('#editBtn').hide();
            // показываем форму редактирования
            $('#editForm').show();
            // заполняем текстовое поле текущим текстом
            $('#editText').val(originalText);
        });

        // обработчик нажатия на кнопку "Отмена"
        $('#cancelBtn').click(function () {
            // скрываем форму редактирования
            $('#editForm').hide();
            // показываем текст и кнопку редактирования
            $('#mes').show();
            $('#editBtn').show();
        });

        // обработчик нажатия на кнопку "сохранить"
        $('#saveBtn').click(function () {
            var newText = $('#editText').val();

            // сохраняем обновленный текст в таблице Messages
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: '/app/ajax.php',
                data: {
                    act: "updateMesById",               // метод обновления сообщения
                    id: id,
                    text: newText
                },
                success: function (data) {
                    if (data.status == 'ok') {
                        // обновляем текст на странице
                        const messageElement = document.getElementById('mes');
                        messageElement.textContent = newText;
                        originalText = newText; // обновляем исходный текст

                        // скрываем форму редактирования
                        $('#editForm').hide();
                        // показываем текст и кнопку редактирования
                        $('#mes').show();
                        $('#editBtn').show();
                        // показываем и скрываем сообщение об успешном изменении
                        showAndHideMessageOk();
                    } else {
                        // показываем и скрываем сообщение об ошибке
                        showAndHideMessageError();
                    }
                },
            });
        });

    });


</script>