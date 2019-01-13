jQuery(function($) {
    // use jQuery code inside this to avoid "$ is not defined" error

    if (window.location.hash == "#wpcf7-f405-o1") {
        $(".registration ").modal("show");
    } else if (window.location.hash == "#wpcf7-f406-o2") {
        $(".modal-reviews ").modal("show");
    }

    $(".btn-loadeMore").click(function(e) {
        e.preventDefault();

        var button = $(this),
            data = {
                action: "loadmore",
                query: lazy_load.posts, // that's how we get params from wp_localize_script() function
                page: lazy_load.current_page
            };

        $.ajax({
            // you can also use $.post here
            url: lazy_load.ajaxurl, // AJAX handler
            data: data,
            type: "POST",
            beforeSend: function(xhr) {
                button.text("Loading..."); // change the button text, you can also add a preloader image
            },
            success: function(data) {
                $(".start-item").remove();
                // count++;
                // console.log("Cout ", count, "data ", data);
                $(".load").append(data);
                if (data) {
                    button.text("More posts").prev();
                    lazy_load.current_page++;

                    if (lazy_load.current_page == lazy_load.max_page) button.remove(); // if last page, remove the button

                    // you can also fire the "post-load" event here if you use a plugin that requires it
                    // $( document.body ).trigger( 'post-load' );
                } else {
                    button.remove(); // if no data, remove the button as well
                }
            }
        });
    });
});
