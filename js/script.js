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

$('#dodajForm').submit(function(event){
    event.preventDefault();

    const $form = $(this);

    const serijalizovan = $form.serialize();
    req = $.ajax({
        url: "handler/add.php",
        type: "post",
        data: serijalizovan
    });

    req.done(function(){
            location.reload();
    });

    req.fail(function(textStatus, errorThrown){
        console.error("Greska je: "+textStatus, errorThrown);
    });

}

)
$('#izmeniForm').submit(function(){
    
    event.preventDefault();
    const forma = $(this);
    const serialized = forma.serialize();


    const obj = forma.serializeArray().reduce(function (json, { name, value }) {
        json[name] = value;
        return json;
    }, {}
    );

    req = $.ajax({
        url: "handler/update.php",
        type: "post",
        data: serialized
    });

    req.done(function(response){
        if (response === "Success") {
            $(`#myTable tbody #tr-${obj["id"]}`).find("td").eq(0).html(obj["naslov"]);
            $(`#myTable tbody #tr-${obj["id"]}`).find("td").eq(1).html(obj["autor"]);
            $(`#myTable tbody #tr-${obj["id"]}`).find("td").eq(2).html(obj["zanr"]);
            $(`#myTable tbody #tr-${obj["id"]}`).find("td").eq(3).html(obj["cena"]);
            alert("Knjiga je izmenjena");    
        }
        else{
            alert("Knjiga nije izmenjena");
        }
    });

    req.fail(function(textStatus, errorThrown){
        console.error("Greska je: "+textStatus, errorThrown);
    });
}
)
function postaviPodatke() {
    var idVal = $('input[name=cekiran]:checked');
    var id = idVal.val();
    
    $("#id").val(id);
   
    event.preventDefault();


    request = $.ajax({
        url: "handler/get.php",
        type: "post",
        data: {'id': id}
    });

    request.done(function (response) {
        if (!(response === "Failed")) {

            response = response.slice(1, -1)
            var obj = JSON.parse(response)

            $('#izmeniForm #naslov').val(obj['naslov'])

            $('#izmeniForm #autor').val(obj['autor'])

            $('#izmeniForm #zanr').val(obj['zanr'])

            $('#izmeniForm #cena').val(obj['cena'])

        } 
    })

    request.fail(function (textStatus, errorThrown) {
        console.error("Greska je: "+textStatus, errorThrown);
    })
}

function sortTable(){

    $('#myTable #tableBody').empty();
    $('#pronadji').val("");

    $.get("handler/sort.php", function (data) {
        let array = data.split("}")
        array.pop()
        array.forEach(element => {
            element = element + "}"
            let obj = JSON.parse(element)

            $("#myTable tbody").append(`
            <tr id="tr-${obj.id}">
                <td>${obj.naslov}</td>
                <td>${obj.autor}</td>
                <td>${obj.zanr}</td>
                <td>${obj.cena}</td>
                <td>
                    <label class="custom-radio-btn">
                        <input type="radio" name="cekiran" value=${obj.id}>
                        <span class="checkmark"></span>
                    </label>
                </td>
            </tr>
        `)
        });
    })
}

