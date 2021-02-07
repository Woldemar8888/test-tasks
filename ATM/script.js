let avalibleArea = document.querySelector('#avalible');
let sumInput = document.querySelector('#sum');
let sendButton = document.querySelector('#send');
let answer = document.querySelector('#answer');
sendButton.addEventListener('click', sendHandler);
let avalibleArr = [5,10,20,50,100,200,500];
let randomCount = Math.ceil(Math.random() * avalibleArr.length);
let arr = [];
let elem;
for(let i =0; i < randomCount; i++){
    do{
       elem = avalibleArr[(Math.ceil(Math.random() * avalibleArr.length)) - 1]; 
    }while(arr.includes(elem));
    arr.push(elem);
}
arr.sort((a,b)=>{
    return a - b;
});
let text = arr.join(', ');
avalibleArea.value = text;
let sum;
let obj = {};
obj['values'] = arr;

function drowAnswer(data, target){
    target.style.display = 'block';
    let content = '';
    
    content += '<p>Ответ:</p>';
    
    if(data['isPossible'] == true){
        content += '<div class="table-area">';
        content += '<table class="sand-background">';
        content += '<tr>';
        content += '<td>Номинал</td>';
        content += '<td>Количество</td>';
        for(let key in data){
            if(key !='isPossible' && key !='min' && key != 'max'){
                content += '<tr>';
                content += '<td>' + key + '</td>';
                content += '<td>' + data[key] + '</td>';
                content += '</tr>';
            }
        }
        content += '</tr>';
        content += '</table>';
    }else{
        let insert;
        if(data['min'] == 0){
            insert = data['max'];
        }else{
            insert = data['min'] + ' или ' + data['max'];
        }
        content += '<div class="wrong-area">';
        content += '<p class="sand-background">';
        content += 'Неверная сумма. Выберите ' + insert + '.';
        content += '</p>';
    }
    content += '</div>';
    target.innerHTML = content;
}

function sendHandler(e){
    e.preventDefault();
    fetch("logic.php", {
            method: "POST",
            body: JSON.stringify(obj) 
        })
        .then(response=>response.text())
        .then(data=>{
        try{
            data = JSON.parse(data);
            drowAnswer(data, answer);
            }catch(e){
                 console.log("error");
                drowAnswer(data, 'Ошибка! Проверьте введенные данные' );
            }   
})   
}


sumInput.oninput = function(e){
    if(e.target.value && e.target.value != 0){
        sendButton.disabled = false;
        sendButton.style.color = 'green';
    }else{
       sendButton.disabled = true;
        sendButton.style.color = 'black';
    }
    obj['sum'] = e.target.value;
}