<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="container text-center">
    <div class="align-items-center text-warning mb-4" style="margin-top: 50px">
        <h4> Страница для работы с сообщениями</h4>
    </div>
</div>

<div class="container text-center">
    <?php if ($data['reg'] == true): ?>
        <h3 class="center text-warning">Новое сообщение внесено!</h3>
        <?php echo
        "<script>
            // задерживаем вывод сообщения на 2 секунды
            setTimeout(function(){
            window.location.href = '/';
            }, 2000); 
            </script>";
    endif; ?>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="messages-container" class="row row-cols-1 row-cols-md-2 g-4">
                <!-- поле для сообщений -->
            </div>
        </div>
    </div>
</div>


<?php if ($data['errors']):
    foreach ($data['errors'] as $error): ?>
        <div class="alert alert-danger">
            <h5 style="color:#fff;" class="center"><?php echo $error; ?> </h5>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


<!-- форма для добавления сообщения-->
<div class="card-footer">
    <h5 class="mb-3">Добавить сообщение</h5>
    <h5 class="mb-3">(пустые поля не допускаются)</h5>
    <form enctype="multipart/form-data" method="post">
        <div class="mb-3">
            <label for="title" class="form-label">Заголовок (не менее 3 и не более 25 символов)</label>
            <input type="text" name="title" id="title" placeholder="Введите заголовок" class="form-control"
                   minlength="3" maxlength="25">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Ваше имя (автор) (не менее 3 и не более 25 символов)</label>
            <input type="text" name="author" id="author" placeholder="Введите ваше имя" class="form-control"
                   minlength="3" maxlength="25">
        </div>
        <div class="mb-3">
            <label for="brief" class="form-label">Краткое содержание (не менее 5 и не более 40 символов)</label>
            <input type="text" name="brief" id="brief" placeholder="Введите краткое содержание"
                   class="form-control" minlength="5" maxlength="40">
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Сообщение (не менее 5 символов)</label>
            <textarea name="message" id="message" rows="3" placeholder="Введите сообщение" class="form-control"
                      minlength="5"></textarea>
        </div>
        <div class="container mt-5 col-3" id="last">
            <div class="row">
                <button class="btn btn-primary text-dark" type="submit" name="action"
                        style="width: 270px; font-size: 18px;">
                    <b>Отправить сообщение</b>
                    <i class="material-icons right">&#xE163;</i>
                </button>
            </div>
        </div>
    </form>
</div>


<script type="text/javascript">
    $(document).ready(function () {
        loadMessages(1);
    });
</script>