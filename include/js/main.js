function createlink() {
    let link = document.getElementsByName('link')[0].value;
    $.ajax({
        url: "ajax.php",
        type: "POST",
        dataType: 'html',
        data: {link: link},
        success: function(data){
            if (data) {
                let response = JSON.parse(data);
                let elm = document.getElementById('links');
                let tr_container = document.createElement('tr');
                $.each(response, function(index, value){
                    let td_item = document.createElement('td');
                    console.log(index);
                        if (index == 'counter') {
                            a_item = document.createElement('div');
                        } else {
                            a_item = document.createElement('a');
                            a_item.href = value;
                        }
                        a_item.innerText = value;
                    td_item.appendChild(a_item);
                    tr_container.appendChild(td_item);
                });
                elm.appendChild(tr_container);
            }
        }
    });
}