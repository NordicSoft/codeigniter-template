(function (window) {
     
    app.init = function () {
        app.log("init");

        initRouter();
        initLayout();
        initAjax();
        initValidator();
    }

    function initRouter() {
        page('/', app.pages.home)
        page('/about', app.pages.about)
        page('/contacts', app.pages.contacts)
        //page('*', app.pages.notfound)
        page({ click: false });
    }

    function initLayout() {
        
        // highlight active main menu link
        var url = location.pathname;
        if (url != "/") {
            url = url.replace(/\/$/, "");
        }
        $("header .navbar-nav li").removeClass("active");
        $("header .navbar-nav li a[href$='" + url + "']").closest("li").addClass("active");

        // activate bootstrap tooltips
        $("body").tooltip({
            trigger : "hover",
            selector: "[data-toggle=tooltip]",
            container: "body"
        });
    }

    // sets ajax defaults
    function initAjax() {
        
        $.ajaxSetup({
            cache: false,
            type: "POST",
            dataType: "json",
            contentType: "application/json; charset=utf-8",
            success: function (data) {
                app.log("global ajax.success function");
                if (!data.Success)
                    app.error(data.Errors);
            },
            error: function (request, textStatus, errorThrown) {
                if (request.status == 401) {
                    window.location = "/signin";
                } else if (request.status == 403) {
                    app.error("You have no enough permissions to request this resource.");
                } else {
                    app.error(errorThrown, textStatus);
                }
            }
        });

        $.ajaxPrefilter(function (options, originalOptions) {
            // Modify options, control originalOptions, store jqXHR, etc
            // if typeof 'data' parameter is not string then stringify it
            if (originalOptions.type.toUpperCase() === "GET") {
                return;
            }
            if (originalOptions.contentType || originalOptions.data === undefined || typeof originalOptions.data == "string") {
                return;
            }
            if (typeof FormData !== "undefined" && originalOptions.data instanceof FormData) {
                return;
            }
            options.data = JSON.stringify(originalOptions.data);
        });
    }

    function initValidator() {
        $.validator.setDefaults({
            ignore: ".ignore, :hidden",
            onfocusout: $.validator.validateElement,
            onkeyup: $.validator.validateElement,
            onclick: false,
            highlight: function (element) {
                $(element).addClass("is-invalid");//.closest("div.form-group").addClass("has-error");
            },
            unhighlight: function (element) {
                $(element).removeClass("is-invalid").closest("div.form-group").find(".form-text.text-danger").text("");
            },
            errorPlacement: function (error, element) {
                $(element).closest("div.form-group").find(".form-text.text-danger").text($(error).text());
            }
        });
    }
})(window);
