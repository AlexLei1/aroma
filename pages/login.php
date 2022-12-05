<!-- ================ start banner area ================= -->
<section class="blog-banner-area" id="category">
	<div class="container h-100">
		<div class="blog-banner">
			<div class="text-center">
				<h1>Вход / Регестрация</h1>
				<nav aria-label="breadcrumb" class="banner-breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="#">Домашняя</a></li>
						<li class="breadcrumb-item active" aria-current="page">Вход/Регистрация</li>
					</ol>
				</nav>
			</div>
		</div>
	</div>
</section>
<!-- ================ end banner area ================= -->

<!--================Login Box Area =================-->
<section class="login_box_area section-margin">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="login_box_img">
					<div class="hover">
						<h4>Еще не зарегистрировались?</h4>
						<p>Для получения доступа к акциям и скидкам стот сделать это прямо сейчас.</p>
						<a class="button button-account" href="/register">Создать аккаунт</a>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="login_form_inner">
					<h3>Вход в личный кабинет</h3>
					<form class="row login_form" onsubmit="sendForm(this); return false;">
						<div class="col-md-12 form-group">
							<input type="email" class="form-control" name="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required />
						</div>
						<div class="col-md-12 form-group">
							<input type="password" class="form-control" name="password" placeholder="Пароль" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Пароль'" required />
						</div>
						<div class="col-md-12 form-group">
							<div class="creat_account">
								<input type="checkbox" id="f-option2" name="selector" required>
								<label for="f-option2">Keep me logged in</label>
							</div>
						</div>
						<div class="col-md-12 form-group">
							<button type="submit" class="button button-login w-100">Войти</button>
						</div>
					</form>
					<p id="info" style="color: red"></p>
				</div>
			</div>
		</div>
	</div>
</section>
<!--================End Login Box Area =================-->
<!-- Модальное окно -->
<div class="modal fade" id="myModal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="staticBackdropLabel">
					Вы успешно авторизировались.
				</h5>
			</div>
			<div class="modal-body">
        Вы будете перенаправлены на страницу пользователя
      </div>
		</div>
	</div>
</div>

<script>
	// функция отправляет данные формы
	async function sendForm(form) {
		info.innerText = "";
		// Записываем данные формы в переменную formDtat
		let formData = new FormData(form);
		//-------------------------------------------------
		// Делаем запрос на сервер для отправки формы
		let response = await fetch("authUser", {
			method: "POST",
			body: formData,
		});
		// Получаем данные в формате json
		let res = await response.json();
		// Работем с данными
		if (res.result === "success") {
			$("#myModal").modal("show");
			setTimeout(() => {
        location.href = "/users/profile";
      }, 3000);
			document.querySelector('[name="email"]').value = '';
			document.querySelector('[name="password"]').value = '';
		} else if (res.result === "exist") {
			info.innerText = "Неверный пароль!";
			document.querySelector('[name="email"]').value = '';
			document.querySelector('[name="password"]').value = '';
		} else if (res.result === 'error') {
			info.innerText = "Такого пользователя нет!"
			document.querySelector('[name="email"]').value = '';
			document.querySelector('[name="password"]').value = '';
		}
	}
</script>