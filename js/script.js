$('#btn-obrisi').click(function(){
    const checked = $('input[name=cekiran]:checked');

    req = $.ajax({
        url: "handler/delete.php",
        type: "post",
        data: {'id': checked.val()}
    });
    
    req.done(function(){
        location.reload();
});

    req.fail(function(textStatus, errorThrown){
        console.error("Greska je: "+textStatus, errorThrown);
    });
}
)