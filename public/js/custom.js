$(() => {
    handleMenu();
});

const handleMenu = () => {
    $(".menu-toggle").on("click", function () {
        $(this).parent().toggleClass("open");
    });

    $(".layout-menu-toggle").on("click", function () {
        $('html').toggleClass("layout-menu-100vh layout-menu-fixed layout-navbar-fixed layout-compact  layout-menu-expanded");
    });
};
