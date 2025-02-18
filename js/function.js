
/* функция вывода через ajax таблицы сообщений на главной странице*/
var Load_messages = function (page) {
    //$("#table tbody").children().remove();
    $("#messages-container").empty();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '/app/ajax.php',
        data: {
            act: "getAllmes",             // метод загрузит всю таблицу сообщений
            page: page
        },
        success: function (data) {
            $.each(data.messages, function (key, value) {
                // Создаем карточку для каждого сообщения
                var card = `
                        <div class="col">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h5 class="card-title">${value.title}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">${value.author}</h6>
                                    <p class="card-text">${value.brief}</p>
                                    <a href="/page/index/${value.id}" class="card-link">Читать полностью</a>
                                </div>
                            </div>
                        </div>
                    `;
                $("#messages-container").append(card);
            });

            // Генерация пагинации
            generatePagination(data.total, page)
        },
        // complete: function () { setTimeout(Load, 5000);  }
    });     // $.ajax
};

// функция для пагинации
function generatePagination(totalMessages, currentPage) {
    var perPage = 3;                                          // число сообщений на одну страницу
    var totalPages = Math.ceil(totalMessages / perPage);   // 10 /3 = 4
    var pagination = $('<div class="pagination"></div>');

    // удаляем старую пагинацию
    $('.pagination').remove();

    // кнопка "предыдущая"
    if (currentPage > 1) {
        pagination.append(`<button class="page-link" onclick="Load_messages(${currentPage - 1})">Предыдущая</button>`);
    }

    // номера страниц
    for (var i = 1; i <= totalPages; i++) {
        var pageLink = $(`<button class="page-link ${i === currentPage ? 'active' : ''}" onclick="Load_messages(${i})">${i}</button>`);
        pagination.append(pageLink);
    }

    // кнопка "следующая"
    if (currentPage < totalPages) {
        pagination.append(`<button class="page-link" onclick="Load_messages(${currentPage + 1})">Следующая</button>`);
    }

    // добавляем пагинацию после конопки отправить сообщение
    $('#last').after(pagination);
}


// функция выводит все комментарии к сообщению
var addComment = function (commentText) {

    // находим список комментариев
    const commentsList = document.getElementById('comments-list');

    // создаем новый элемент <li>
    const newCommentItem = document.createElement('li');
    newCommentItem.className = 'list-group-item';

    // создаем внутреннюю структуру
    const commentDiv = document.createElement('div');
    commentDiv.className = 'd-flex justify-content-between';

    const commentParagraph = document.createElement('p');
    commentParagraph.className = 'mt-2 mb-0';
    commentParagraph.innerHTML = `<b>● </b> ${commentText}`;

    // собираем структуру
    commentDiv.appendChild(commentParagraph);
    newCommentItem.appendChild(commentDiv);
    commentsList.appendChild(newCommentItem);

    //document.getElementById('comment-input').value = '';
}

// функция получения всех комментариев по id сообщения
var Load_comments = function (id) {
    var result;
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '/app/ajax.php',
        data: {
            act: "getCommByIdMes",             // метод получит все комментарии к сообщению по id
            id: id
        },
        success: function (data) {
            $.each(data, function (key, value) {
                addComment(value.text_);
            });
        },
        // complete: function () { setTimeout(Load, 5000);  }
    });
}

// функция показывает сообщение об успешной записи отредактированного сообщения
function showAndHideMessageOk() {
    $('#acceptMes').show(); // Показываем сообщение об успешной записи
    setTimeout(function () {
        $('#acceptMes').hide(); // Скрываем сообщение через 2 секунды
    }, 2000);
}

// функция показывает сообщение об ошибке при попытке записи отредактированного сообщения
function showAndHideMessageError() {
    $('#errorMes').show(); // Показываем сообщение об ошибке
    setTimeout(function () {
        $('#errorMes').hide(); // Скрываем сообщение через 2 секунды
    }, 2000);
}




















/* функция загрузки записи курьера по id через AJAX*/
var Load_courier_by_id = function (id) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '/app/ajax.php',
        async: false,                               // чтобы result вернулся после выполнения запроса, иначе вернется undefined, сначала запрос - потом ответ
        data: {
            act: "load_courier_by_id",             // загружаем запись курьера по id
            id: id
        },
        success: function (data) {
            result = data.surname;
        },
    });
    return result;
};

/* функция загрузки записи города по id через AJAX*/
var Load_town_by_id = function (id) {
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '/app/ajax.php',
        async: false,                               // чтобы result вернулся после выполнения запроса, иначе вернется undefined, сначала запрос - потом ответ
        data: {
            act: "load_town_by_id",                 // загружаем наименование города по id
            id: id
        },
        success: function (data) {
            //result = data.town;
            result = data;
        },
    });
    return result;
};

/* функция получения данных для таблицы заказов через AJAX
и вывода данных в таблице на странице */


