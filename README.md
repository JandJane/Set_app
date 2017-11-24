## Set

This is a web-app for Facebook and VK, which is based on a popular card game [SET](https://www.setgame.com/set). 
(VK is a social network, russian analogue of Facebook, <https://vk.com>)

![screenshot](https://pp.userapi.com/c626717/v626717105/c988/YmbElZlkRH0.jpg)

You can find working versions of the Set game on both Facebook ([here](https://apps.facebook.com/findset)) and VK ([here](https://vk.com/app5164422_36753388)).
In this repository we have two separated branches for two different platforms.

Please **note!** that this game was initially designed for Russian network. Therefore, VK version is more developed (*for example, in Facebook version I do not have a feature of displaying profile pictures of top-players. However, Facebook API is not very different from VK's one so I plan to add it soon)* 

Also, the game is not translated yet, but you can always read the rules [here](https://www.setgame.com/learn-to-play). 

### How does that work? ###
This is an iframe-app (a web-site, in fact) so I used HTML+CSS and JavaScript mainly to develop it. 

VK / Facebook APIs were used to get users' info (name, id, profile pic).

Users' data and best scores are stored at MySQL db, so some PHP was used to display a table with top players. 

AJAX helped me to implement data exchange between JS and PHP.

The game has two modes: classic and a speed one (where you have only 2 minutes to sind sets).

### How do I recognize a set? ###

Each card has 4 properties, each property takes 3 different values:
* color - green, red or purple
* form of the figure - ellipse, rhombus or a wave
* number of figures - one, two or three
* filling - filled, shaded or empty

I encoded cards in ternary code - from 0000 to 2222 - 81 unique cards in total.
```javascript
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
```
So now to check whether three cards make up a set we just need to check if the sum of their codes for each property is divided by 3.

```javascript 
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
```
---
You are very welcome with your commits and suggestions

You can always contact me via email: foggyjandjane@gmail.com

