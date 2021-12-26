
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title><?= config_item('app_name').' | '.config_item('company_name') ?></title>
    <meta property="og:type" content="software" />
    <meta property="og:title" content="<?= config_item('app_name') ?>" />
    <meta property="og:description" content="Blood Donation Management Portal" />
    <meta property="og:image" content="<?= base_url()?>assets/media/bg/bg_1.png" />
    <meta property="og:url" content="<?= base_url() ?>" />
    <meta property="og:site_name" content="<?= config_item('app_name') ?>" />
    <meta name="theme-color" content="#ed0838">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?= base_url()?>assets/css/pages/login/classic/login-1.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url()?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url()?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url()?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?= base_url()?>assets/media/logos/bloodbank20.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
            <!--begin::Aside-->
            <div class="login-aside d-flex flex-row-auto bgi-size-cover bgi-no-repeat p-10 p-lg-10" style="background-image: url(<?= base_url()?>assets/media/bg/bg-blood.png);">
                <!--begin: Aside Container-->
                <div class="d-flex flex-row-fluid flex-column justify-content-between">
                    <!--begin: Aside header-->
                  <!--   <a href="#" class="flex-column-auto mt-5 pb-lg-0 pb-10">
                        <img src="<?= base_url()?>assets/media/logos/<?= config_item('company_logo') ?>" class="max-h-70px" alt="" />
                    </a> -->
                    <!--end: Aside header-->
                    <!--begin: Aside content-->
                    <div class="flex-column-fluid d-flex flex-column justify-content-center">
                        <h3 class="font-size-h1 mb-5 text-white">Welcome to <?= config_item('app_name')  ?> !</h3>
                        <p class="font-weight-lighter text-white opacity-80">Blood Donation Management Portal for all Blood Donation Communities</p>
                    </div>
                    <!--end: Aside content-->
                    <!--begin: Aside footer for desktop-->
                    <div class="d-none flex-column-auto d-lg-flex justify-content-between mt-10">
                        <div class="opacity-70 font-weight-bold text-white">© <?= config_item('app_name') ?></div>
                        <div class="d-flex">
                            <!-- <a href="#" class="text-white">Privacy</a> -->
                            <!-- <a href="#" class="text-white ml-10">Legal</a> -->
                            <!-- <a href="tel:919061431496" class="text-white ml-10">Contact</a> -->
                        </div>
                    </div>
                    <!--end: Aside footer for desktop-->
                </div>
                <!--end: Aside Container-->
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="d-flex flex-column flex-row-fluid position-relative p-7 overflow-hidden">

                <!--end::Content header-->
                <!--begin::Content body-->
                <div class="d-flex flex-column-fluid flex-center mt-30 mt-lg-0">
                    <!--begin::Signin-->
                    <div class="login-form login-signin">

                        <div class="d-flex flex-center mb-5">
                            <a href="#">
                                <img src="<?= base_url() ?>assets/media/logos/logo-nbrt.png" class="max-h-120px" width="100%" alt="" />
                            </a>
                        </div>
                        
                        <div class="text-center mb-10 mb-lg-20">
                            <!-- <h3 class="font-size-h1"><?= config_item('company_name')?></h3> -->
                            <p class="text-muted font-weight-bold">Enter your username and password</p>
                        </div>


                        <!--begin::Form-->
                        <form autocomplete="off" class="form" id="kt_login_signin_form" action="javascript:;" method="POST">
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="text" placeholder="Username" name="username" autocomplete="off" />
                            </div>
                            <div class="form-group">
                                <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Password" name="password" autocomplete="off" />
                            </div>
                            <!--begin::Action-->
                            <div class="form-group d-flex flex-wrap justify-content-between align-items-center">

                                <span class="text-dark-50 text-hover-primary my-3 mr-2"></span>
                                <button type="button" id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 float-right">Sign In</button>
                            </div>
                            <!--end::Action-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Signin-->

                </div>
                <!--end::Content body-->
                <!--begin::Content footer for mobile-->
                <div class="d-flex d-lg-none flex-column-auto flex-column flex-sm-row justify-content-between align-items-center mt-5 p-5">
                  <div class="text-dark-50 font-weight-bold order-2 order-sm-1 my-2">© <?= date('Y')?> <?= config_item('app_name') ?></div>
                  <div class="d-flex order-1 order-sm-2 my-2">
                    <a href="tel:919061431496" class="text-white ml-10">Contact</a>
                </div>
            </div>
            <!--end::Content footer for mobile-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Login-->
</div>
<!--end::Main-->
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="<?= base_url()?>assets/plugins/global/plugins.bundle.js"></script>
<script src="<?= base_url()?>assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="<?= base_url()?>assets/js/scripts.bundle.js"></script>


<style type="text/css">
   .hidden{
    display: none !important;
}
</style>

<script type="text/javascript">

   var validation;

        // Init form validation rules. For more info check the FormValidation plugin's official documentation:https://formvalidation.io/
        validation = FormValidation.formValidation(
            KTUtil.getById('kt_login_signin_form'),
            {
                fields: {
                    username: {
                        validators: {
                            notEmpty: {
                                message: 'Username is required'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'Password is required'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    submitButton: new FormValidation.plugins.SubmitButton(),
                    //defaultSubmit: new FormValidation.plugins.DefaultSubmit(), // Uncomment this line to enable normal button submit after form validation
                    bootstrap: new FormValidation.plugins.Bootstrap()
                }
            }
            );

        $('#kt_login_signin_submit').on('click', function (e) {
            e.preventDefault();

            var btn = $(this);
            var form = $(this).closest('form');
            var action = "<?php echo base_url()?>login/login_process";

            var btn_text = $(this).html();
            var btn_loading_text = btn_text+'<span class="spinner ml-3"></span>';

            $(btn).html(btn_loading_text);

            validation.validate().then(function(status) {
                if (status == 'Valid') {;

                    $(btn).html(btn_loading_text);

                    $.ajax({
                        type: "POST",
                        url: action,
                        data: form.serialize(), 
                        success: function(data)
                        {

                            $(btn).html(btn_text);

                            var obj = $.parseJSON(data);

                            var content = {};

                            if(obj.status==1){
                                content.message = 'Logging into Dashboard !';
                                content.title = '';
                                content.icon = 'icon ';

                                var notify = $.notify(content, {
                                    type: 'success',
                                    allow_dismiss: false,
                                    newest_on_top: true,
                                    mouse_over:  false,
                                    showProgressbar:  false,
                                    spacing: 10,
                                    timer: 2000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    },
                                    offset: {
                                        x: 30,
                                        y: 30
                                    },
                                    delay: 500,
                                    z_index: 10000,
                                    animate: {
                                        enter: 'animate__animated animate__fadeIn',
                                        exit: 'animate__animated animate__fadeOut'
                                    },
                                // onShow: function() {
                                //     this.css({'width':'80%','height':'auto'});
                                // },
                            });

                                setTimeout(function() {

                                    window.open('<?php echo base_url()?>dashboard', '_self');

                                }, 2000);

                            }else if(obj.status==2){

                                content.message = 'Your account suspended, Please Contact the admin !';
                                content.title = '';
                                content.icon = '';

                                var notify = $.notify(content, {
                                    type: 'danger',
                                    allow_dismiss: false,
                                    newest_on_top: true,
                                    mouse_over:  false,
                                    showProgressbar:  false,
                                    spacing: 10,
                                    timer: 2000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    },
                                    offset: {
                                        x: 30,
                                        y: 30
                                    },
                                    delay: 500,
                                    z_index: 10000,
                                    animate: {
                                        enter: 'animate__animated animate__fadeIn',
                                        exit: 'animate__animated animate__fadeOut'
                                    },
                                // onShow: function() {
                                //     this.css({'width':'80%','height':'auto'});
                                // },
                            });

                            }
                            else if(obj.status==3){

                                content.message = 'Another session is logged In, !';
                                content.title = '';
                                content.icon = '';

                                var notify = $.notify(content, {
                                    type: 'danger',
                                    allow_dismiss: false,
                                    newest_on_top: true,
                                    mouse_over:  false,
                                    showProgressbar:  false,
                                    spacing: 10,
                                    timer: 2000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    },
                                    offset: {
                                        x: 30,
                                        y: 30
                                    },
                                    delay: 500,
                                    z_index: 10000,
                                    animate: {
                                        enter: 'animate__animated animate__fadeIn',
                                        exit: 'animate__animated animate__fadeOut'
                                    },
                                // onShow: function() {
                                //     this.css({'width':'80%','height':'auto'});
                                // },
                            });

                            }
                            else{

                                content.message = 'Invalid Credentials, Please check !';
                                content.title = '';
                                content.icon = 'icon ';

                                var notify = $.notify(content, {
                                    type: 'danger',
                                    allow_dismiss: false,
                                    newest_on_top: true,
                                    mouse_over:  false,
                                    showProgressbar:  false,
                                    spacing: 10,
                                    timer: 2000,
                                    placement: {
                                        from: 'top',
                                        align: 'center'
                                    },
                                    offset: {
                                        x: 30,
                                        y: 30
                                    },
                                    delay: 500,
                                    z_index: 10000,
                                    animate: {
                                        enter: 'animate__animated animate__fadeIn',
                                        exit: 'animate__animated animate__fadeOut'
                                    },
                                // onShow: function() {
                                //     this.css({'width':'80%','height':'auto'});
                                // },
                            });

                            }


                        }
                    });


} else {

    var content = {};

    content.message = 'Please enter username and password';
    content.title = '';
    content.icon = 'icon la la-warning';
                    // content.url = 'www.keenthemes.com';
                    // content.target = '_blank';

                    var notify = $.notify(content, {
                        type: 'warning',
                        allow_dismiss: false,
                        newest_on_top: true,
                        mouse_over:  false,
                        showProgressbar:  false,
                        spacing: 10,
                        timer: 2000,
                        placement: {
                            from: 'top',
                            align: 'center'
                        },
                        offset: {
                            x: 30,
                            y: 30
                        },
                        delay: 500,
                        z_index: 10000,
                        animate: {
                            enter: 'animate__animated animate__fadeIn',
                            exit: 'animate__animated animate__fadeOut'
                        }
                    });


                }
            });
});






</script>

</body>
<!--end::Body-->
</html>