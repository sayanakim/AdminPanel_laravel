$(document).ready(function () {
    $(".nav-treeview .nav-link, .nav-link").each(function () {
        let location2 = window.location.protocol + '//' + window.location.host + window.location.pathname;
        let link = this.href;
        if(link == location2){
            $(this).addClass('active');
            $(this).parent().parent().parent().addClass('menu-is-opening menu-open');

        }
    });

    $('.delete-btn').click(function () {
        let res = confirm('Подтвердите действия');
        if(!res){
            return false;
        }
    });
})


