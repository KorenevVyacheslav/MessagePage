
/* функция вывода через ajax таблицы сообщений на главной странице*/
var Load_messages = function () {
    $("#table tbody").children().remove();
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: '/app/ajax.php',
        data: {
            act: "getAllmes"             // метод загрузит всю таблицу сообщений
        },
        success: function (data) {
            var N = 1;                      // номер в таблице при выводе
            $.each(data, function (key, value) {
                $("#table tbody").append(`
          <tr>
            <td><b>${N}</b></td>
            <td><b>${value.title}</b></td>
            <td><b>${value.brief}</b></td>
            <td>
              <b>
               <a href="/page/index/${value.id}">      
                <i>...</i>  
               </a>
              </b>
<!--               <i class="material-icons">&#xE163;</i> не отражается стрелочка, (разобраться!) --> 
            </td>
          </tr>
        `);
                N++;
            });
        },
        // complete: function () { setTimeout(Load, 5000);  }
    });
};

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

// функция получения всех комментариев
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


