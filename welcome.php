<?php include ('element/navbar.php'); ?>
<div v-cloak id="welcome" class="main-container view-welcome">

    <!-- Slide 1-->
    <section v-bind:class="{ hidden: slide !== 1, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_1@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">

                            <h1>{{ lang.WELCOME.SLIDE1_TITLE }}</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE1_TEXT1 }}</p>
                            <p class="lead">{{ lang.WELCOME.SLIDE1_TEXT2 }}</p>
                            <p class="lead">{{ lang.WELCOME.SLIDE1_TEXT3 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a id="welcome-slide1-button-signup" class="btn btn--primary type--uppercase w-100" href="#"  v-on:click="changeSlide(2)">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.SIGN_UP }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center ">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome"></p></li>
                                <li><p class="circle-welcome"></p></li>
                                <li><p class="circle-welcome"></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slide 2-->
    <section v-bind:class="{ hidden: slide !== 2, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_2@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">
                            <h1>{{ lang.WELCOME.SLIDE2_TITLE }}</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE2_TEXT1 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <input v-on:input="checkUsername" class="validate-required" type="text" v-bind:placeholder="lang.WELCOME.SLIDE2_INPUT_PLACEHOLDER" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a class="btn btn--primary type--uppercase w-100" v-on:click="changeSlide(3, validUsername)">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.CONTINUE }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome"></p></li>
                                <li><p class="circle-welcome"></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <!-- Slide 3-->
    <section v-bind:class="{ hidden: slide !== 3, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_3@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">
                            <h1>{{ lang.WELCOME.SLIDE3_TITLE }}</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE3_TEXT1 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <input v-on:input="checkEmail" class="validate-required" type="text" v-bind:placeholder="lang.WELCOME.SLIDE3_INPUT_PLACEHOLDER" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row">
                                <div class="col-md-6 col-6">
                                    <a class="btn btn--transparent type--uppercase w-100" href="#"  v-on:click="changeSlide(2)">
                                        <span id="welcome-slide3-button-back" class="btn__text">
                                            {{ lang.BUTTON.GO_BACK }}
                                        </span>
                                    </a>
                                </div>
                                <div class="col-md-6 col-6">
                                    <a class="btn btn--primary type--uppercase w-100" href="#" v-on:click="sendConfirmationMail()">
                                        <span id="welcome-slide3-button-continue" class="btn__text">
                                            {{ lang.BUTTON.CONTINUE}}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome"></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!--end of row-->
        </div>
        <!--end of container-->
    </section>

    <!-- Slide 4-->
    <section v-bind:class="{ hidden: slide !== 4, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_4@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">
                            <h1>{{ lang.WELCOME.SLIDE4_TITLE }}</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE4_TEXT1 }}</p>
                        </div>
                    </div>

                    <div class="row  justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slide 5-->
    <section v-bind:class="{ hidden: slide !== 5, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_5@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">
                            <h1>{{ lang.WELCOME.SLIDE5_TITLE }} {{ username }}!</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE5_TEXT1 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a class="btn btn--primary type--uppercase w-100" href="#" v-on:click="changeSlide(6)">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.CONTINUE }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome "></p></li>
                                <li><p class="circle-welcome "></p></li>
                                <li><p class="circle-welcome "></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slide 6-->
    <section v-bind:class="{ hidden: slide !== 6, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_6-7@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">

                            <h1>{{ lang.WELCOME.SLIDE6_TITLE }}</h1>
                            <p class="lead">{{ lang.SLIDE6_TEXT1 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <input v-on:input="inputPassword" class="validate-required" type="text" v-bind:value="suggestedPassword" name="My Input" v-bind:placeholder="lang.WELCOME.SLIDE6_INPUT_PLACEHOLDER" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row">
                                <div class="col-md-6">
                                    <a class="btn btn--transparent type--uppercase w-100" href="#">
                                        <span class="btn__text btn_copy" data-clipboard-target="#welcome-slide6-input">
                                            {{ lang.BUTTON.COPY_PASSWORD }}
                                        </span>
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn--black type--uppercase w-100" href="#" v-on:click="suggestPassword()">
                                        <span class="btn__text color--white">
                                            {{ lang.BUTTON.NEW_PASSWORD }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 offset-md-3">
                                    <a class="btn btn--primary type--uppercase w-100" href="#" v-on:click="changeSlide(7)">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.CONTINUE }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome"></p></li>
                                <li><p class="circle-welcome "></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slide 7-->
    <section v-bind:class="{ hidden: slide !== 7, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_6-7@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">
                            <h1>{{ lang.WELCOME.SLIDE7_TITLE }}</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE7_TEXT1 }}</p>
                            <p class="lead">{{ lang.WELCOME.SLIDE7_TEXT2 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <input v-on:input="inputCheckPassword" class="validate-required" type="text" name="My Input" v-bind:placeholder="lang.WELCOME.SLIDE7_INPUT_PLACEHOLDER" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 col-terms">
                            <div class="input-checkbox">
                                <input v-on:change="checkTerms" id="welcome-check-terms" type="checkbox" name="agree_terms" />
                                <label for="welcome-check-terms"></label>
                            </div>
                            <span>{{ lang.WELCOME.SLIDE7_CHECKBOX1 }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12">
                            <div class="input-checkbox">
                                <input v-on:change="checkPolicy" id="welcome-check-policy" type="checkbox" name="agree_policy" />
                                <label for="welcome-check-policy"></label>
                            </div>
                            <span>{{ lang.WELCOME.SLIDE7_CHECKBOX2 }}</span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a class="btn btn--primary type--uppercase w-100" href="#" v-on:click="createAccount()">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.CREATE_ACCOUNT }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome "></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Slide 8-->
    <section v-bind:class="{ hidden: slide !== 8, imageblock: true, switchable: true, 'height-100': true }">
        <div class="imageblock__content col-lg-6 col-md-6 col-sm-12 pos-right">
            <div class="background-image-holder">
                <img alt="image" src="img/welcome/creary_slide_8@2x.jpg" class="logo-welcome" />
            </div>
        </div>
        <div class="container pos-vertical-center content-slide-welcome no-padding">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-justify">
                            <img class="logo-welcome" src="img/welcome/logo-welcome.png" alt="">
                            <h1>{{ lang.WELCOME.SLIDE8_TITLE }}</h1>
                            <p class="lead">{{ lang.WELCOME.SLIDE8_TEXT1 }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10 offset-lg-1 col-md-12 text-center">
                            <div class="row justify-content-center">
                                <div class="col-auto">
                                    <a class="btn btn--primary type--uppercase w-100" href="/">
                                        <span class="btn__text">
                                            {{ lang.BUTTON.CONTINUE }}
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="text-center">
                            <ul class="list-inline list-unstyled ul-row-pagination">
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                                <li><p class="circle-welcome active"></p></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>
<?php include ('element/footer.php'); ?>