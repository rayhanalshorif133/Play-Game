$(() => {
    handleSideMenu();
});

const handleSideMenu = () => {
    $(".menu-toggle").on("click", function () {
        $(this).parent().toggleClass("open");
    });
};
