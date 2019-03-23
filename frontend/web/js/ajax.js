function f(id){

    var cont = document.getElementById("answer");
    var choosed = document.getElementById(id);
    cont.innerHTML = cont.innerHTML + ' '+ '<a id="'+ id +'" title="Отменить" onClick="f_rev('+id+')">'+ choosed.innerHTML + '</a>';
    choosed.remove();
    return false;
}

function f_rev(id){
    var cont2 = document.getElementById('random-word');
    var choosed2 = document.getElementById(id.id);
    cont2.innerHTML = cont2.innerHTML + " "+ "<a href='#' title='Выбрать' id='"+id.id+"' onClick=f('"+id.id+"')>"+choosed2.innerHTML+"</a>";
    choosed2.remove();
    return false;
}

$('#check-result').on('click', function(){
   var text = $('#answer').text();
   var id_ans = $(this).data('id');
   var res = document.querySelector('#result');
   var next = id_ans;
   $.ajax({
        contentType: "application/json; charset=utf-8"
    });
    $.post("/play/check-result",
        {
            text: text,
            id_task: id_ans
        },
        function(data, status){
            //console.log(data);
            data = JSON.parse(data);
            if(data['status'] == true) {
                $("*[data-id=" + id_ans + "]").remove();
                next += 1;
                res.innerHTML = '<center><h2 style="color: lightgreen">' + data['data'] +
                    '</h2><a class="btn btn-primary" href="/play/decision?task='+ next +'">Следущее задание</a>' +
                    '<h3>Количество побед: '+ data['wins'] +'</h3>'+
                    '<h3>Количество поражений: '+ data['loses'] +'</h3>'+
                    '<h3>Среднее число побед: '+ data['avg_win'] +'%' +'</h3>'+
                    '<h3>Среднее число поражений: '+ data['avg_lose'] +'%' +'</h3>'+
                    '<h3>Количество игр: '+ data['played'] +'</h3></center>';
            }else{
                res.innerHTML = '<center><h2 style="color: red">' + data['data'] +
                    '</h2><a class="btn btn-warning" href="/play/decision?task='+ next +'">Следущее задание</a>' +
                    '<h3>Количество побед: '+ data['wins'] +'</h3>'+
                    '<h3>Количество поражений: '+ data['loses'] +'</h3>'+
                    '<h3>Среднее число побед: '+ data['avg_win']  +'%'+'</h3>'+
                    '<h3>Среднее число поражений: '+ data['avg_lose'] +'%' +'</h3>'+
                    '<h3>Количество игр: '+ data['played'] +'</h3></center>';
            }
            return false;
        });
    
    return false;
});