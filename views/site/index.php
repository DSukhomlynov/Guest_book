<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
?>

<!--MENU SECTION END-->
<!--HOME SECTION START-->
<div id="home" >
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-2 col-md-8 col-md-offset-2 col-lg-8 col-lg-offset-2 ">
				<div id="carousel-slider" data-ride="carousel" class="carousel slide  animate-in" data-anim-type="fade-in-up">
					<div class="carousel-inner">
						<div class="item active">
							<h3>
								Тестовое задание для бекенд девелопера:реализация гостевой книги
							</h3>
							<p>
								Гостевая книга работает без аутентификации и авторизации<br>
								Для каждого сообщения задается имя автора<br>
								Для каждого сообщения должны выводиться дата и время
								отправки.<br>
							</p>
						</div>
						<div class="item">
							<h3>
								Тестовое задание для бекенд девелопера:реализация гостевой книги
							</h3>
							<p>
								К каждому сообщению можно прикрепить произвольное число
								изображений.<br>
								Для каждого отправляемого сообщения можно прикрепить ссылку
								на свой сайт.<br>
								Каждому сообщению можно поставить лайк<br>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-8 col-lg-offset-2 scroll-me">
				<p >
					Ссылки на различные сервисы(если успею запилить)
				</p>
				<div class="social">
					<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-facebook "></i></a>
					<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-twitter"></i></a>
					<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-google-plus "></i></a>
					<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-linkedin "></i></a>
					<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-pinterest "></i></a>
					<a href="#" class="btn button-custom btn-custom-one" ><i class="fa fa-github "></i></a>
				</div>
				<a href="#records" class=" btn button-custom btn-custom-two">Перейти к реализации</a>
			</div>
		</div>
	</div>
</div>
<!--HOME SECTION END-->
<!--SERVICE SECTION START-->
<section id="records" >
	<div class="container">
		<div class="row text-center header">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
				<h3>Записи</h3>
				<hr />
			</div>
		</div>
		<?php foreach ($records as $record): ?>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-12">
				<div class="records-wrapper">
					<h3><?= $record->author ?><h4>(<?= $record->date ?>)</h4></h3>
					<hr>
					<?= $record->content ?>
					<hr>
					<p>Link:<a href=<?= $record->link ?>>&nbsp;Ссылка на сайт</a></p>
					<p>Likes:<?= $record->likes ?></p>
					<p><?php
                        $images = $record->getImages();
					    foreach ($images as $image):
						echo Html::img($image->getUrl('150x150'));
					    endforeach
						?>
					</p>
				</div>
			</div>
		</div>
        <?php endforeach ?>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-12">
		<?php
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
		?>
			</div>
		</div>
	</div>
</section>
<!--SERVICE SECTION END-->
<!--SERVICE SECTION START-->
<section id="add" >
	<div class="container">
		<div class="row text-center header">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 animate-in" data-anim-type="fade-in-up">
				<h3>Добавить запись</h3>
				<hr />
			</div>
		</div>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-12">
				<div class="add-wrapper">
					<h2>Добавление записи</h2>
					<!--					<form role="form">-->
					<!--						<div class="form-group">-->
					<!--							<label for="email"><h3>Name:</h3></label>-->
					<!--							<input type="email" class="form-control" id="email" placeholder="Введите email">-->
					<!--						</div>-->
					<!--						<div class="form-group">-->
					<!--							<label for="pass"><h3>Text:</h3></label>-->
					<!--							<textarea class="form-control" id="email" placeholder="Введите email"></textarea>-->
					<!--						</div>-->
					<!--						<div class="form-group">-->
					<!--							<label for="pass"><h3>Link:</h3></label>-->
					<!--							<input type="password" class="form-control" id="pass" placeholder="Пароль">-->
					<!--						</div>-->
					<!--						<button type="submit" class="btn button-custom btn-custom-two">Отправить</button>-->
					<!--					</form>-->
                    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
                    <?= $form->field($entry, 'author') ?>
                    <?= $form->field($entry, 'content') ?>
                    <?= $form->field($entry, 'link') ?>
                    <?= $form->field($entry, 'gallery[]')->fileInput(['multiple' => true, 'accept' => 'image/*']) ?>
                    <?= Html::submitButton('Отправить', ['class' => 'btn button-custom btn-custom-two']) ?>
                    <?php ActiveForm::end() ?>
				</div>
			</div>
		</div>
	</div>
</section>
<!--SERVICE SECTION END-->
<!--CONTACT SECTION START-->
<section id="contact" >
	<div class="container">
		<div class="row text-center header animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<h3>Контакты</h3>
				<hr />
			</div>
		</div>
		<div class="row animate-in" data-anim-type="fade-in-up">
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="contact-wrapper">
					<h3>Социальные сети</h3>
					<p>
						Исчерпывающая информация обо мне и моих навыках
					</p>
					<div class="social-below">
						<a href="https://www.linkedin.com/in/dmytro-sukhomlynov/" class="btn button-custom btn-custom-two" > LinkedIn</a>
						<a href="https://github.com/DSukhomlynov" class="btn button-custom btn-custom-two" > GitHub</a>
						<a href="https://vk.com/id56341285" class="btn button-custom btn-custom-two" >VK</a>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="contact-wrapper">
					<h3>Связь со мной</h3>
					<h4><strong>Email : </strong> dm.sukhomlynov@gmail.com </h4>
					<h4><strong>Call : </strong> +380955903036 </h4>
					<h4><strong>Skype : </strong> Дмитрий Сухомлинов </h4>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<div class="contact-wrapper">
					<h3>Адрес : </h3>
					<h4>85611, Дачное , </h4>
					<h4>Украина</h4>
					<div class="footer-div" >
						&copy; 2017 YourDomain
					</div>
				</div>
			</div>
		</div>
	</div>
</section>