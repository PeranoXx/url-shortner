$(function () {

    // register user
    $("#register-form").submit((e) => {
        e.preventDefault();

        // get values from form
        var $inputs = $("#register-form :input");
        var values = {};
        $inputs.each(function () {
            values[this.name] = $(this).val();
        });
        console.log(values);

        $.ajax({
            url: "/register",
            method: "POST",
            data: values,
            success: function (data) {
                if (data.status == "success") {
                    console.log(data);
                } else {
                }
            },
        });
    });

    // login user
    $("#login-form").submit((e) => {
        e.preventDefault();

        // get values from form
        var $inputs = $("#login-form :input");
        var values = {};
        $inputs.each(function () {
            values[this.name] = $(this).val();
        });
        console.log(values);

        $.ajax({
            url: "/login",
            method: "POST",
            data: values,
            success: function (data) {
                if (data.status == "success") {
                    console.log(data);
                } else {
                }
            },
        });
    });

    // url shortner
    $("#url-form").submit((e) => {
        e.preventDefault();

        // get values from form
        var $inputs = $("#url-form :input");
        var values = {};
        $inputs.each(function () {
            values[this.name] = $(this).val();
        });

        // ajax call
        $.ajax({
            url: "/home",
            method: "POST",
            data: values,
            success: function (data) {
                if (data.status == "success") {
                    $("#url_error").html("");
                    $("#display_url").prepend(
                        `
                        <div class="card text-left shadow-md rounded-md mt-10 p-5">
                            <div class="grid grid-cols-5 gap-4 items-center">
                                <div class="col-span-2">
                                    <p id="domain_name">${data.data.domain}</p>
                                </div>
                                <div class="flex justify-between col-span-2" id="short_url">
                                    <a href="${data.data.short_url}" target="_blank" class="text-blue-600 pr-5" id="${data.data.key}">
                                        ${data.data.short_url}
                                    </a>
                                    <p class="cursor-pointer copy_url" id="${data.data.key}"><i class="fa-solid fa-copy"></i></p>
                                </div>
                                <div class="text-end">
                                    <a href="/states"  class="text-2xl"><i class="fa-solid fa-rocket"></i></a>
                                </div>
                            </div>
                        </div>
                        `
                    );
                    $("#enterd-url").val("");
                    console.log(data);
                } else {
                    console.log(data);
                    $("#url_error").html(data.message);
                }
            },
        });
    });

    // copy link to clipboard
    $(document).on("click", ".copy_url", function () {
        const val = $(this).attr("id");
        const range = document.createRange();
        range.selectNode(document.getElementById(val));
        window.getSelection().removeAllRanges();
        window.getSelection().addRange(range);
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        alert("link copied");
    });
});
