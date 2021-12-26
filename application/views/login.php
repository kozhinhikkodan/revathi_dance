
<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <meta charset="utf-8" />
    <title><?= config_item('app_name').' '.config_item('version') ?> | Admin Panel</title>
    <meta name="description" content="<?= config_item('app_name') ?> Login to Dashboard" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="canonical" href="<?= base_url() ?>" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Page Custom Styles(used by this page)-->
    <link href="<?= base_url() ?>assets/css/pages/login/classic/login-5.css" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles-->
    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="<?= base_url() ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <!--end::Global Theme Styles-->
    <!--begin::Layout Themes(used by all pages)-->
    <link href="<?= base_url() ?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url() ?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
    <!--end::Layout Themes-->
    <link rel="shortcut icon" href="<?= base_url() ?>assets/media/logos/favicon.ico" />
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    <!--begin::Main-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Login-->
        <div class="login login-5 login-signin-on d-flex flex-row-fluid" id="kt_login">
            <div class="d-flex flex-center bgi-size-cover bgi-no-repeat flex-row-fluid" style="background-image: url(<?= base_url() ?>assets/media/bg/bg-2.jpg);">
                <div class="login-form text-center text-white p-7 position-relative overflow-hidden">
                    <!--begin::Login Header-->
                    <div class="d-flex flex-center mb-5">
                        <a href="#">
                            <img src="<?= base_url() ?>assets/media/logos/<?= config_item('company_logo') ?>" class="max-h-120px" alt="" />
                        </a>
                    </div>
                    <!--end::Login Header-->
                    <!--begin::Login Sign in form-->
                    <div class="login-signin">
                        <div class="mb-20">
                            <h3 class="opacity-40 font-weight-normal"><?= config_item('app_name') ?></h3>
                            <p class="opacity-40">Enter your details to login to your account </p>
                        </div>


                        <form autocomplete="off" class="form" id="kt_login_signin_form" action="javascript:;" method="POST">

                            <div class="form-group">
                                <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" type="text" placeholder="Email" name="username" autocomplete="off" />
                            </div>

                            <div class="form-group">
                                <input class="form-control h-auto text-white bg-white-o-5 rounded-pill border-0 py-4 px-8" autocomplete="off" type="password" placeholder="Password" name="password" />
                            </div>

                            <div class="form-group text-center mt-10">
                                <button type="submit" id="kt_login_signin_submit" class="btn btn-pill btn-primary opacity-90 px-15 py-3">Sign In
                                    
                                </button>
                            </div>

                        </form>

                    </div>
                    <!--end::Login Sign in form-->
                    <!--begin::Login Sign up form-->


                </div>
            </div>
        </div>
        <!--end::Login-->
    </div>
    <!--end::Main-->
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="<?= base_url() ?>assets/plugins/global/plugins.bundle.js"></script>
    <script src="<?= base_url() ?>assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
    <script src="<?= base_url() ?>assets/js/scripts.bundle.js"></script>

            <!-- <script src="https://preview.keenthemes.com/metronic/theme/html/demo1/dist/assets/js/scripts.bundle.js?v=7.1.7"></script> -->

    <!--end::Global Theme Bundle-->
    <!--begin::Page Scripts(used by this page)-->
    <!-- <script src="<?= base_url() ?>assets/js/pages/custom/login/login-general.js"></script> -->

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

                        }else{

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
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>