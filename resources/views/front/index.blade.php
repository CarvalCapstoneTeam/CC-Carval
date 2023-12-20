<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== FAVICON ===============-->
    <link rel="shortcut icon" href="{{ asset('assets/front/img/logo-carval.png') }}" type="image/x-icon" />

    <!--=============== BOXICONS ===============-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css" />

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/swiper-bundle.min.css') }}" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('assets/front/css/styles.css') }}" />

    <title>Carval</title>
</head>

<body>
    <!--==================== HEADER ====================-->
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">
                <img src="{{ asset('assets/front/img/logo1.png') }}" alt="" class="nav__logo-img" />
            </a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">Home</a>
                    </li>

                    <li class="nav__item">
                        <a href="#about" class="nav__link">About</a>
                    </li>

                    <li class="nav__item">
                        <a href="#features" class="nav__link">Services</a>
                    </li>

                    <li class="nav__item">
                        <a href="#members" class="nav__link">Members</a>
                    </li>

                </ul>

                <div class="nav__close" id="nav-close">
                    <i class="bx bx-x"></i>
                </div>

                <img src="{{ asset('assets/front/img/nav-img.png') }}" alt="" class="nav__img" />
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class="bx bx-grid-alt"></i>
            </div>
        </nav>
    </header>

    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home container" id="home">
            <div class="swiper home-swiper">
                <div class="swiper-wrapper">
                    <!-- HOME SLIDER 1 -->
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="{{ asset('assets/front/img/home0.png') }}" alt="" class="home__img" />
                                <div class="home__indicator"></div>

                                <div class="home__details-img">
                                    <h4 class="home__details-title">The "Carval"</h4>
                                    <span class="home__details-subtitle">Mobile application for applicant job</span>
                                </div>
                            </div>

                            <div class="home__data">
                                <div class="blue-gradient-600">
                                    <h3 class="home__subtitle">#1 Phylosophy</h3>
                                    <h1 class="home__title">
                                        CARRER <br />
                                        VALIDITY <br />
                                        APPS
                                    </h1>
                                    <p class="home__description">
                                        Empowering individuals to navigate the job market with confidence, Carval aims
                                        to minimize the risk of falling victim to fraudulent job listings.
                                </div>

                                <div class="home__buttons">
                                    <a href="#" class="button">Download Now <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="{{ asset('assets/front/img/solution1.png') }}" alt=""
                                    class="home__img" />
                                <div class="home__indicator"></div>

                                <div class="home__details-img">
                                    <h4 class="home__details-title">Main Feature</h4>
                                    <span class="home__details-subtitle">Check your job vacancy</span>
                                </div>
                            </div>

                            <div class="home__data">
                                <h3 class="home__subtitle">#2 Top features</h3>
                                <h1 class="home__title">
                                    CHECK <br />
                                    YOUR JOB <br />
                                    VACANCY
                                </h1>
                                <p class="home__description">
                                    Using our latest machine learning model, get information about whether you are
                                    applying for the right job or not.
                                </p>

                                <div class="home__buttons">
                                    <a href="#" class="button">Download Now <i
                                            class="bi bi-arrow-right md"></i></a>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- HOME SLIDER 3 -->
                    <section class="swiper-slide">
                        <div class="home__content grid">
                            <div class="home__group">
                                <img src="{{ asset('assets/front/img/home4.png') }}" alt="" class="home__img" />
                                <div class="home__indicator"></div>

                                <div class="home__details-img">
                                    <h4 class="home__details-title">Added Feature</h4>
                                    <span class="home__details-subtitle">Get all job articles</span>
                                </div>
                            </div>

                            <div class="home__data">
                                <h3 class="home__subtitle">#3 Top Features</h3>
                                <h1 class="home__title">
                                    GET <br />
                                    ALL JOB <br />
                                    ARTICLE
                                </h1>
                                <p class="home__description">
                                    Through our app, you can also, get information about jobs around the world so
                                    you won't get caught anymore
                                </p>

                                <div class="home__buttons">
                                    <a href="#" class="button">Download Now <i
                                            class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </section>

        <!--==================== ABOUT ====================-->
        <section class="section about" id="about">
            <div class="about__container container grid">
                <div class="about__data">
                    <h2 class="section__title about__title">ABOUT CARVAL</h2>
                    <p class="about__description">
                        Designed to offer a reliable solution, our application addresses the challenges faced by job
                        seekers dealing with fraudulent job listings. We empower users to verify the authenticity of job
                        postings, enabling them to pursue opportunities without the fear of scams. Join us in
                        simplifying the job search experience and safeguarding your time and money
                    </p>
                    <a href="#" class="button">Know more</a>
                </div>

                <img src="{{ asset('assets/front/img/about.png') }}" alt="" class="about__img" />
            </div>
        </section>

        <!--==================== solution ====================-->
        <section class="section solution" id="features">
            <h2 class="section__title">OUR SOLUTION</h2>

            <div class="solution__container container grid">
                <div class="solution__data">
                    <img src="{{ asset('assets/front/img/solution1.png') }}" alt="" class="solution__img" />
                    <h3 class="solution__title">Jova</h3>
                    <p class="solution__description">Detection your job vacancy</p>
                </div>

                <div class="solution__data">
                    <img src="{{ asset('assets/front/img/solution2.png') }}" alt="" class="solution__img" />
                    <h3 class="solution__title">Arca</h3>
                    <p class="solution__description">Article about job and carrer</p>
                </div>
            </div>
        </section>

        <!--==================== MEMBER ====================-->
        <section class="section member" id="members">
            <h2 class="section__title ">CARVAL TEAM</h2>

            <div class="member__container container">
                <div class="swiper member-swiper">
                    <div class="swiper-wrapper">
                        <div class="member__content swiper-slide">
                            <div class="member__CC">CC</div>
                            <img src="{{ asset('assets/front/img/team1.png') }}" alt=""
                                class="member__img" />
                            <h3 class="member__title">Iman Carrazi Syamsidi</h3>
                            <span class="member__subtitle">Sriwijaya University</span>
                            <h3 class="member__title">C315BSY3131</h3>
                            <a href="https://www.linkedin.com/in/iman-carrazi/" class="button member__button">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>

                        <div class="member__content swiper-slide">
                            <div class="member__CC">CC</div>
                            <img src="{{ asset('assets/front/img/team2.png') }}" alt=""
                                class="member__img" />
                            <h3 class="member__title">Dewa Sheva Dzaky</h3>
                            <span class="member__subtitle">Sriwijaya University</span>
                            <h3 class="member__title">C315BSY3177</h3>
                            <a href="https://www.linkedin.com/in/dewa-sheva-dzaky/" class="button member__button">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>

                        <div class="member__content swiper-slide">
                            <div class="member__ML">ML</div>
                            <img src="{{ asset('assets/front/img/team3.png') }}" alt=""
                                class="member__img" />
                            <h3 class="member__title">Eka Wira Yudha</h3>
                            <span class="member__subtitle">Sriwijaya University</span>
                            <h3 class="member__title">M315BSY0951 </h3>
                            <a href="https://www.linkedin.com/in/eka-wira-yudha-705649221/"
                                class="button member__button">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>

                        <div class="member__content swiper-slide">
                            <div class="member__ML">ML</div>
                            <img src="{{ asset('assets/front/img/team4.png') }}" alt=""
                                class="member__img" />
                            <h3 class="member__title">Aprijal Turnip</h3>
                            <span class="member__subtitle">Padjadjaran University</span>
                            <h3 class="member__title">M011BSY1054</h3>
                            <a href="https://www.linkedin.com/in/aprijalturnip/" class="button member__button">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>

                        <div class="member__content swiper-slide">
                            <div class="member__ML">ML</div>
                            <img src="{{ asset('assets/front/img/team6.png') }}" alt=""
                                class="member__img" />
                            <h3 class="member__title">Ajeng Tessa Ningrum</h3>
                            <span class="member__subtitle">Pamulang University</span>
                            <h3 class="member__title">M288BSX1324</h3>
                            <a href="https://www.linkedin.com/in/ini-ajeng/" class="button member__button">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>

                        <div class="member__content swiper-slide">
                            <div class="member__MD">MD</div>
                            <img src="{{ asset('assets/front/img/team5.png') }}" alt=""
                                class="member__img" />
                            <h3 class="member__title">Billy Franko</h3>
                            <span class="member__subtitle">Multi Data Palembang University</span>
                            <h3 class="member__title">A694BSY2183</h3>
                            <a href="https://www.linkedin.com/in/billy-franko-6aa500288/"
                                class="button member__button">
                                <i class="bi bi-linkedin"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </section>

        <!--==================== supported ====================-->
        <section class="section supported" id="supported">
            <h2 class="section__title">SUPPORTED BY</h2>
            <div class="supported__container container grid">
                <img src="{{ asset('assets/front/img/Bangkit.png') }}" alt="" class="supported__img" />
                <img src="{{ asset('assets/front/img/kampus-merdeka.png') }}" alt=""
                    class="supported__img" />
            </div>
        </section>

        <!--==================== OUR membersLETTER ====================-->
        <section class="section membersletter">
            <div class="membersletter__container container">
                <h2 class="section__title">Share your thoughts</h2>
                <p class="membersletter__description">
                    Have something to say? Share your thoughts with us! We value your voice
                </p>

                <form action="" class="membersletter__form">
                    <input type="text" placeholder="Enter your message" class="membersletter__input" />
                    <button class="button">Send</button>
                </form>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content">
                <a href="#" class="footer__logo">
                    <img src="{{ asset('assets/front/img/logo1.png') }}" alt="" class="footer__logo-img" />
                    Carval
                </a>

                <p class="footer__description">
                    Mobile application for applicant job
                </p>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Contact</h3>

                <ul class="footer__links">
                    <li>
                        <a href="mailto:carvalindo23@gmail.com" class="footer__link"><i class="bi bi-envelope-fill"></i> Email</a>
                    </li>
                    <li>
                        <a href="mailto:carvalindo23@gmail.com" class="footer__link">carvalindo23@gmail.com</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Our Services</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#features" class="footer__link">Jova</a>
                    </li>
                    <li>
                        <a href="#features" class="footer__link">Arca</a>
                    </li>
                </ul>
            </div>

            <div class="footer__content">
                <h3 class="footer__title">Supported By</h3>

                <ul class="footer__links">
                    <li>
                        <a href="#supported" class="footer__link">Bangkit Academy</a>
                    </li>
                    <li>
                        <a href="#supported" class="footer__link">Kampus Merdeka</a>
                    </li>
                </ul>
            </div>
        </div>

        <span class="footer__copy">&#169; Carval Capstone Team. All rights reserved</span>

        <img src="{{ asset('assets/front/img/footer2.png') }}" alt="" class="footer__img-two" />
        <img src="{{ asset('assets/front/img/footer1.png') }}" alt="" class="footer__img-one" />
    </footer>

    <!--=============== SCROLL UP ===============-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="bx bx-up-arrow-alt scrollup__icon"></i>
    </a>

    <!--=============== SCROLL REVEAL ===============-->
    <script src="{{ asset('assets/front/js/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('assets/front/js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('assets/front/js/main.js') }}"></script>
</body>

</html>
