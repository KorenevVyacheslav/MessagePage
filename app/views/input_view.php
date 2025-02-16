<link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<div class="container text-center">
    <div class="align-items-center text-warning" style="margin-top: 50px">
        <h3> Страница работы с сообщениями</h3>
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

<div class="container text-center">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div style="margin-top: 10px"><h4 class="text-warning"> Ваши сообщения:</h4></div>
                    <table id="table" class="table table-bordered  border-warning text-dark data-table bg-secondary"
                       style="margin-top: 20px">
                        <thead>
                        <tr>
                            <th>№</th>
                            <th>Заголовок</th>
                            <th>Краткое содержание</th>
                            <th>Читать/редактировать</th>
                        </tr>
                        </thead>
                    <tbody></tbody>
                    </table>
                </div>  <!-- <div class="col-md-8">  -->
            </div>      <!-- <div class="row justify-content-center">   -->


        <!-- форма для добавления сообщения-->
        <div class="card-footer">
            <h5 class="mb-3">Добавить сообщение</h5>
            <h5 class="mb-3">(пустые поля не допускаются)</h5>
            <form enctype="multipart/form-data" method="post">
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок (не менее 3 и не более 25 символов)</label>
                    <input type="text" name="title" id="title" placeholder="Введите заголовок" class="form-control"
                           minlength="3" maxlength="25" required>
                </div>
                <div class="mb-3">
                    <label for="author" class="form-label">Ваше имя (автор) (не менее 3 и не более 25 символов)</label>
                    <input type="text" name="author" id="author" placeholder="Введите ваше имя" class="form-control"
                           minlength="3" maxlength="25" required>
                </div>
                <div class="mb-3">
                    <label for="brief" class="form-label">Краткое содержание (не менее 5 и не более 40 символов)</label>
                    <input type="text" name="brief" id="brief" placeholder="Введите краткое содержание"
                           class="form-control" minlength="5" maxlength="40" required>
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label">Сообщение</label>
                    <textarea name="message" id="message" rows="3" placeholder="Введите сообщение" class="form-control"
                              minlength="5" required></textarea>
                </div>
                <div class="container mt-5 col-3">
                    <div class="row">
                        <button class="btn btn-primary text-dark" type="submit" name="action">
                            <b>Отправить сообщение</b>
                            <i class="material-icons right">&#xE163;</i>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php if ($data['errors']):
            foreach ($data['errors'] as $error): ?>
                <div class="alert alert-danger">
                    <h5 style="color:#fff;" class="center"><?php echo $error; ?> </h5>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div> <!--class="container text-center"> -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        Load_messages();
    });

</script>