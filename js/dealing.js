var inst_name;

for (var i = 0; i <= 11; i++)
{

        inst_name = cards.pop();
        instance_cards.push(inst_name);
        document.getElementById(i).src = "img/" + inst_name + ".gif";

}