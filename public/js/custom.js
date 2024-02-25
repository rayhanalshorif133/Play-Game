$(() => {
    handleSideMenu();
});

const handleSideMenu = () => {
    $(".menu-toggle").on("click", function () {
        $(".menu-toggle").toggleClass("active");
    });
};
