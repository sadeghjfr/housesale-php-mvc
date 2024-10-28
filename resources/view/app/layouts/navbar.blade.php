
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar" style="direction: rtl;">
    <div class="container">
        <a class="navbar-brand" href="<?= route('home.index') ?>">Royal<span>estate</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="oi oi-menu"></span> منو
      </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item <?= sidebarActive(route('home.index'), false) ?>"><a href="<?= route('home.index') ?>" class="nav-link">خانه</a></li>
                <li class="nav-item <?= sidebarActive(route('home.all.ads')) ?>"><a href="<?= route('home.all.ads') ?>" class="nav-link">آگهی ها</a></li>
                <li class="nav-item <?= sidebarActive(route('home.about')) ?>"><a href="<?= route('home.about') ?>" class="nav-link">درباره ما</a></li>
                <li class="nav-item <?= sidebarActive(route('home.about')) ?>"><a href="<?= route('home.index') ?>" class="nav-link">بلاگ</a></li>
                <li class="nav-item <?= sidebarActive(route('home.about')) ?> cta"><a href="<?= route('auth.login') ?>" class="nav-link ml-lg-1 mr-lg-5"><span class="icon-user m-2"></span>ورود</a></li>
                <li class="nav-item <?= sidebarActive(route('home.about')) ?> cta cta-colored"><a href="<?= route('auth.register') ?>" class="nav-link"><span class="icon-pencil m-2"></span>ثبت نام</a></li>

            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->