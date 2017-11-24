function compareNumeric(a, b) {
	return +a - +b;
}

stripe.style.height = '10px';
stripe.style.margin = '93px 0 0 1px'; 
stripe.style.background = '#df1417';
chose.style.display = 'none';

var cards = [];  // create list of cards
var instance_cards = [];
var cards_on_table = 12;


var counter_text = document.getElementById('counter');
var counter = 0;
counter_text.innerHTML = '<font color = "#f1e7c4"> Сеты: </font>' + String(counter);


var scores = 0;
var scores_text = document.getElementById('score');
scores_text.innerHTML = '<font color = "#f1e7c4"> Очки: </font>' + String(scores);

var cards_left = document.getElementById('cards_left');
cards_left.innerHTML = '<font color = "#f1e7c4"> Карт: </font> 69';

var butt_add_disabled = 0;

// fill the list with cards (81 unique cards)
for(var i = 0; i <= 2; i++){
    for(var j = 0; j <= 2; j++){
        for(var k = 0; k <= 2; k++){
            for(var l = 0; l <= 2; l++){
                cards.push(String(i) + String(j) + String(k) + String(l));
            }
        }
    }
}


cards.random_shuffle = function()  // shuffles list of cards
{
    for (var i = this.length - 1; i > 0; i--)
    {
        var num = Math.floor(Math.random() * (i + 1));
        var d = this[num];
        this[num] = this[i];
        this[i] = d;
    }
    return this;
};
cards.random_shuffle();



function check_if_set(first, second, third)
{
    for (var m = 0; m <= 3; m++)  // for each of 4 properties
    {
        if ((+first[m] + +second[m] + +third[m]) % 3 != 0)
        {
            return false;
        }
    }
    return true;
}

var clicked = []
function save_clicked(card_number)
{
    if (card_number == clicked[0])
    {
        document.getElementById(clicked[0]).style.background = "url(img/none.png)";
        clicked.splice(0, 1);
    } else if (card_number == clicked[1]) {
        document.getElementById(clicked[1]).style.background = "url(img/none.png)";
        clicked.splice(1, 1);
    } else {
        clicked.push(+card_number);
        document.getElementById(card_number).style.background = "url(img/bg.gif)";
        if (clicked.length == 3) {
            if (check_if_set(instance_cards[clicked[0]], instance_cards[clicked[1]], instance_cards[clicked[2]]))
            {
                scores += 3;
                document.getElementById('score_post').value = scores;
                counter++;
                alert_win.style.background =  '#dff0d8';
                alert_win.style.border = '1px solid #d6e9c6';
                alert_win.innerHTML = '<strong>Сет убран:</strong> +3 очка.';
                counter_text.innerHTML = '<font color = "#f1e7c4"> Сеты: </font>' + String(counter);
                cards_left.innerHTML = '<font color = "#f1e7c4"> Карт: </font>' + String(cards.length);
                scores_text.innerHTML = '<font color = "#f1e7c4"> Очки: </font>' + String(scores);
                if (cards_on_table == 12) {
                    if (cards.length == 0) {
                        show_results();
                    } else {
                        for (i = 0; i < 3; i++) {
                            inst_name = cards.pop();
                            instance_cards[clicked[i]] = inst_name;
                            document.getElementById(clicked[i]).src = "img/" + inst_name + ".gif";
                            document.getElementById(clicked[i]).style.background = "url(img/none.png)";
                        }
                        if (cards.length == 0) {
                            butt_add_disabled = 1;
                        }
                    }

                } else {
                    clicked.sort(compareNumeric);
                    for (i = 0; i < 3; i++) {
                        instance_cards.splice(clicked[i] - i, 1);
                        document.getElementById(clicked[i]).style.background = "url(img/none.png)";
                    }
                    document.getElementById(12).hidden = 'hidden';
                    document.getElementById(13).hidden = 'hidden';
                    document.getElementById(14).hidden = 'hidden';
                    for (i = 0; i < 12; i++) {
                        document.getElementById(i).src = "img/" + instance_cards[i] + ".gif"
                    }
                    cards_on_table = 12;
                    butt_add_disabled = 0
                    if (cards.length == 0) {
                        butt_add_disabled = 1;
                    }
                }
            } else {
                document.getElementById(clicked[0]).style.background = "url(img/none.png)";
                document.getElementById(clicked[1]).style.background = "url(img/none.png)";
                document.getElementById(clicked[2]).style.background = "url(img/none.png)";
                scores -= 1;
                document.getElementById('score_post').value = scores;
                scores_text.innerHTML = '<font color = "#f1e7c4"> Очки: </font>' + String(scores);
                alert_win.style.background =  '#f0d2d4';
                alert_win.style.border = '1px solid #ddc0c2';
                alert_win.innerHTML = '<strong>Это не сет!</strong> -1 очко.';
            }
            clicked = []
        }
    }
}


window.onload = function(){
    timme = Math.floor(new Date().getTime() / 1000);
    var div = document.getElementById('time');
    (function(){
        var date = new Date();
        if (Math.floor(new Date().getTime() / 1000) - timme <= 120) {
            div.innerHTML = 'Время: ' + (120 - (Math.floor(new Date().getTime() / 1000) - timme)) + ' сек';
            window.setTimeout(arguments.callee, 1000);
        } else {
            show_results_time();
        }
    })();

};

			
function find_set()
{
    if (cards_on_table == 15) {
        for (i = 0; i < cards_on_table; i++) {
            for (j = i + 1; j < cards_on_table; j++) {
                for (k = j + 1; k < cards_on_table; k++) {
                    if (check_if_set(instance_cards[i], instance_cards[j], instance_cards[k])) {
                        scores -= 3;
                        document.getElementById('score_post').value = scores;
                        scores_text.innerHTML = '<font color = "#f1e7c4"> Очки: </font>' + String(scores);
                        alert_win.style.background =  '#d0e7f0';
                        alert_win.style.border = '1px solid #c1d8e1';
                        alert_win.innerHTML = '<strong>Подсказка:</strong> -3 очка.';
                        switch_on();
                        window.setTimeout(switch_on, 300);
                        window.setTimeout(switch_on, 600);
                        return;
                    }

                }
            }
        }
        alert_win.style.background =  '#f0d2d4';
        alert_win.style.border = '1px solid #ddc0c2';
        alert_win.innerHTML = '<strong>Нет сетов!</strong>';
    } else {
        for (i = 0; i < cards_on_table; i++) {
            for (j = i + 1; j < cards_on_table; j++) {
                for (k = j + 1; k < cards_on_table; k++) {
                    if (check_if_set(instance_cards[i], instance_cards[j], instance_cards[k])) {
                        scores -= 3;
                        document.getElementById('score_post').value = scores;
                        scores_text.innerHTML = '<font color = "#f1e7c4"> Очки: </font>' + String(scores);
                        alert_win.style.background =  '#d0e7f0';
                        alert_win.style.border = '1px solid #c1d8e1';
                        alert_win.innerHTML = '<strong>Подсказка:</strong> -3 очка.';
                        switch_on();
                        window.setTimeout(switch_on, 400);
                        window.setTimeout(switch_on, 800);
                        return;
                    }
                }
            }
        }
        alert_win.style.background =  '#f0d2d4';
        alert_win.style.border = '1px solid #ddc0c2';
        alert_win.innerHTML = '<strong>Нет сетов!</strong>';
    }
}

			
function show_cards()
{
    if (butt_add_disabled != 1) {
    	for (i = 12; i <= 14; i+=1)
    	{
    		inst_name = cards.pop();
    		instance_cards.push(inst_name)
    		document.getElementById(i).src = "img/" + inst_name + ".gif";
    		document.getElementById(i).hidden = '';
    	}
    	butt_add_disabled = 1;
        cards_left.innerHTML = '<font color = "#f1e7c4"> Карт: </font>' + String(cards.length);
    	cards_on_table = 15;
    }

}
 
function newColor(idCell) {
	document.getElementById(idCell).style.background = "#bf8b67";
}

function backColor(idCell) {
	document.getElementById(idCell).style.background = "#eba16c";
}

function switch_on() {
    document.getElementById(i).style.background = "url(img/bg1.gif)";
    document.getElementById(j).style.background = "url(img/bg1.gif)";
    document.getElementById(k).style.background = "url(img/bg1.gif)";
    window.setTimeout(switch_off, 200);

}

function switch_off() {
    document.getElementById(i).style.background = "url(img/none.png)";
    document.getElementById(j).style.background = "url(img/none.png)";
    document.getElementById(k).style.background = "url(img/none.png)";
}

function rules_alert(){
    bg.style.display = 'inline';
	rules.style.top = '110px';
}

function rules_hide() {
	rules.style.top = '-610px';
	bg.style.display = 'none';
}

function show_results() {
    bg.style.display = 'inline';
	result.style.top = '255px';
	var results = document.createElement('p');
	if (score_post.value == 0){
	    results.innerHTML = '<h4 align = "center">Не расстраивайтесь!</h4> <strong>Ваш результат: </strong>' + 0 + ' очк. за ' + (Math.floor(new Date().getTime() / 1000) - timme) + ' сек';
	} else {
    	results.innerHTML = '<h4 align = "center">Поздравляем!</h4> <strong>Ваш результат: </strong>' + scores + ' очк. за ' + (Math.floor(new Date().getTime() / 1000) - timme) + ' сек';
    }
    result.appendChild(results);
    $.ajax({
        type: "POST",
        url: "handler_blitz.php",
        data: 'score=' + score_post.value + '&id=' + users_id.value+'&time=' + (Math.floor(new Date().getTime() / 1000) - timme) + '&name=' + users_name.value + '&photo_url=' + photo_url.value,
        success: function(response){}
    });
}

function show_results_time() {
    bg.style.display = 'inline';
	result.style.top = '255px';
	var results = document.createElement('p');
	if (score_post.value == 0){
	    results.innerHTML = '<h4 align = "center">Не расстраивайтесь!</h4> <strong>Ваш результат: </strong>' + 0 + ' очк. за 120 сек';
	} else {
    	results.innerHTML = '<h4 align = "center">Поздравляем!</h4> <strong>Ваш результат: </strong>' + scores + ' очк. за 120 сек';
    }
    result.appendChild(results);
    $.ajax({
        type: "POST",
        url: "handler_blitz.php",
        data: 'score=' + score_post.value + '&id=' + users_id.value+'&time=' + (Math.floor(new Date().getTime() / 1000) - timme) + '&name=' + users_name.value + '&photo_url=' + photo_url.value,
        success: function(response){}
    });
}

function restart() {
        $.ajax({
            type: "POST",
            url: "handler_blitz.php",
            data: 'score=' + score_post.value + '&id=' + users_id.value+'&time=' + (Math.floor(new Date().getTime() / 1000) - timme) + '&name=' + users_name.value + '&photo_url=' + photo_url.value,
            success: function(response){}
        });
        location.reload();
}

function rating_alert(){
    bg.style.display = 'inline';
	rating.style.top = '120px';
}

function rating_hide() {
    bg.style.display = 'none';
	rating.style.top = '-605px';
}

function chose_alert(){
    if (chose.style.display == 'none') {
        chose.style.display = 'block';
    } else {
        chose.style.display = 'none';
    }
}

function classic(){
    rating_iframe.src = 'classic.php';
    option.style.left = '121px';
}

function blitz(){
    option.style.left = '233px';
    rating_iframe.src = 'blitz_.php';
}

function study_alert(){
    bg.style.display = 'inline';
    study.style.top = '80px';
}

function study_hide(){
    bg.style.display = 'none';
	study.style.top = '-710px';
}


    