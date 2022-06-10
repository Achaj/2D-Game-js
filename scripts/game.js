const canvas= document.getElementById('canvas1');
const ctx = canvas.getContext('2d');
canvas.width= 900;
canvas.height= 600;
//global varibles
const cellSize=100;
const cellGap=3;
const gameGrid=[];
const defenders=[];
let defendercost= 100;
let numberOfRecources =300;
const enemies=[];
const enemiesPosition=[];
let frame=0;
let enemiesInterval=1000;
let gameOver=false;
const projectiles=[];
let score=0;
const recources=[];
let winScore=50;
let chosenDefender=1;
let extraPower=1;

// mouse
const mouse ={
    x: undefined,
    y: undefined,
    width: 0.1,
    height: 0.1,
    clicked: false
}
canvas.addEventListener('mousedown', function(){
    mouse.clicked=true;
});
canvas.addEventListener('mouseup', function(){
    mouse.clicked=false;
});
let canvasPosition=canvas.getBoundingClientRect();
canvas.addEventListener('mousemove', function(e){
    mouse.x= e.x - canvasPosition.left;
    mouse.y= e.y - canvasPosition.top;
});

canvas.addEventListener('mouseleave', function(){
    mouse.x=undefined;
    mouse.y=undefined;
});

// console.log(canvasPosition);
// game board

const controlsBar={
    width: canvas.width,
    height: cellSize,
}
class Cell{
    constructor(x,y){
        this.x=x;
        this.y=y;
        this.width=cellSize;
        this.height=cellSize;

    }
    draw(){
        if(mouse.x && mouse.y && collisoion(this, mouse)){
            ctx.strokeStyle='black';
            ctx.strokeRect(this.x,this.y,this.width,this.height);
        }
        
    }
}
//
function createGrid(){
    for(let y= cellSize;y < canvas.height;y +=cellSize){
        for(let x= 0; x < canvas.width;x +=cellSize){
            gameGrid.push(new Cell(x,y))
        }
    }
}
//
createGrid();
// class Prokecttile
class Prokecttile{
    constructor(x,y){
        this.x=x;
        this.y=y;
        this.width=10;
        this.height =10;
        this.power =20;
        this.speed =7;
        this.extraPower=extraPower;
        
    }
    update(){
        this.x+=this.speed;
    
    }
    draw(){
        ctx.fillStyle='black';
        ctx.beginPath();
        ctx.arc(this.x,this.y,this.width,0,Math.PI*2);
        ctx.fill();
    }

}
function handleProjectiles(){
    for(let i=0;i<projectiles.length;i++){
        projectiles[i].update();
        projectiles[i].draw();
//redukcaj zrowia przeciwnika
        for(let j =0 ;j< enemies.length; j++){
            if(enemies[j] && projectiles[i] && collisoion(projectiles[i],enemies[j])){
                enemies[j].health-=projectiles[i].power + projectiles[i].extraPower;
                console.log(i +'extra '+projectiles[i].extraPower);
                projectiles.splice(i,1);
                i--;
            }
        }

        if(projectiles[i] && projectiles[i].x > canvas.width-cellSize){
            projectiles.splice(i,1);
            i--;

        }
        //console.log('projectiles'+ projectiles.length)
    }
}
// defenders
const defenderTypes=[];
const defender1= new Image();
defender1.src='assetsgame/defender1.png';
defenderTypes.push(defender1);
const defender2= new Image();
defender2.src='assetsgame/defender2.png';
defenderTypes.push(defender2);


class Defender{
    constructor(x,y){
        this.x=x;
        this.y=y;
        this.width=cellSize - cellGap ;
        this.height=cellSize - cellGap ;
        this.shooting =false;
        this.health=0;
        this.projectiles=[];
        this.shotingNow=false;
        this.timer=0;
        this.frameX=0; 
        this.frameY=0;
        this.minFrame=0;
        this.maxFrame=18;
        this.spriteWidth=194;
        this.spriteHeight=194;
        this.chosenDefendr=chosenDefender;

        if(this.chosenDefendr==1){
            this.health=120;
        }else  if(this.chosenDefendr==2){
            this.health=170;
            numberOfRecources-=50;
        }
    }
    draw(){
       // ctx.fillStyle = 'blue';
       // ctx.fillRect(this.x,this.y,this.width,this.height);
        ctx.fillStyle = 'gold';
        ctx.font= '30px Arial';
        ctx.fillText(Math.floor(this.health),this.x+15,this.y+25);
      //ctx.drawImage(img,sx,sy,sw,sh,dx,dy,dw,dh);

      if(this.chosenDefendr===1){
        ctx.drawImage(defender1,this.frameX* this.spriteWidth,0,this.spriteWidth,this.spriteHeight,this.x,this.y,this.width,this.height);
      }else if(this.chosenDefendr ===2){
        ctx.drawImage(defender2,this.frameX* this.spriteWidth,0,this.spriteWidth,this.spriteHeight,this.x,this.y,this.width,this.height);
      }
    }
    update(){
        if(frame % 10 === 0){
            if(this.frameX < this.maxFrame){
                this.frameX++;
            }else{
                this.frameX=this.minFrame;
            }
            if(this.frameX === 9){
                this.shotingNow=true;
                //console.log('nie mam mnie tu');
            }
        }
        if(this.chosenDefendr ===1){
            if(!this.shotingNow){
                this.minFrame=9;
                this.maxFrame=23;
            }else{
                this.minFrame=0;
                this.maxFrame=7;
            }
        }else  if(this.chosenDefendr ===2){
            if(!this.shotingNow){
                this.minFrame=0;
                this.maxFrame=9;
            }else{
                this.minFrame=10;
                this.maxFrame=14;
            }
        }
      
        //console.log('now'+ this.shotingNow);
        //console.log('shoot'+this.shooting);
        if(this.shooting &&  this.shotingNow){
            if(this.chosenDefendr ===1){
                projectiles.push(new Prokecttile(this.x+70,this.y+50));
                extraPower=0
                this.shotingNow=false;
            }else  if(this.chosenDefendr ===2){
                projectiles.push(new Prokecttile(this.x+70,this.y+50,100));
                this.shotingNow=false;
                extraPower=5;
            }
        }
    }
}
canvas.addEventListener('click', function(){
    const gridPositionX= mouse.x - (mouse.x % cellSize) +cellGap;
    const gridPositionY= mouse.y - (mouse.y % cellSize) +cellGap;
    if(gridPositionY< cellSize) return;
    let defendercost=100;
    for(let i=0; i< defenders.length;i++){
        if(defenders[i].x== gridPositionX && defenders[i].y==gridPositionY)
        return;
    }
    if(numberOfRecources >= defendercost){
        defenders.push(new Defender(gridPositionX,gridPositionY));
        numberOfRecources-= defendercost;
    }else{
        floatingMessages.push(new floatingMasage('brak środków', mouse.x, mouse.y,20,'green'));
    }
});
//odejmowanie przeciwników i redukcja życia
function handleDefenders(){
    for(let i=0;i< defenders.length; i++){
        defenders[i].draw();
        defenders[i].update();
        if(enemiesPosition.indexOf(defenders[i].y) !== -1){
            defenders[i].shooting=true;
        }else{
            defenders[i].shooting=false;
        }
            for(let j =0; j< enemies.length;j++){
                if(defenders[i] &&  collisoion(defenders[i],enemies[j])){
                    //zbijanie życia jeśli jest kolizja
                    enemies[j].movment=0;
                    defenders[i].health-=(0.2);
                }if(defenders[i] && defenders[i].health <= 0){
                    defenders.splice(i,1);
                    i--;
                    enemies[j].movment=enemies[j].speed;
                }
            }
    }
}

function handleGameGrid(){
    for(let i=0;i< gameGrid.length; i++){
        gameGrid[i].draw();
    }
}
//recources extra coin 
const coin= new Image();
coin.src='assetsgame/bonus.png';

const amounts=[7,14,21,3,10,5,15,25];
class Resourse{
    constructor(){
        this.x = Math.random() * (canvas.width-cellSize);
        this.y = Math.floor(Math.random() *5 + 1)*cellSize +25;
        this.width= cellSize*0.6;
        this.height=cellSize*0.6;
        this.amount= amounts[Math.floor(Math.random() *amounts.length)];
    }
    draw(){
        ctx.fillStyle='yellow';
       // ctx.fillRect(this.x,this.y,this.width,this.height);
        ctx.drawImage(coin,0,0,128,128,this.x,this.y,this.width,this.height);
        ctx.fillStyle = 'white';
        ctx.font= '20px Orbitron';
        ctx.fillText(this.amount ,this.x+22,this.y+25);
    }
}
function handleRecourse(){
    if(frame % 500 === 0 && score < winScore){
        recources.push(new Resourse());
    }
    for(let i =0; i< recources.length ;i++){
        recources[i].draw();
        if(recources[i] && mouse.x && mouse.y && collisoion(recources[i],mouse)){
            numberOfRecources+=recources[i].amount;
            floatingMessages.push(new floatingMasage('+'+recources[i].amount,recources[i].x,recources[i].y,30,'black'));
            floatingMessages.push(new floatingMasage('+'+recources[i].amount,250,30,30,'gold'));
            recources.splice(i,1);
            i--;
        }
    }
}

// utilites 

var startTime = performance.now();
var timePlayer=0;

function handleGameStatus(){
    ctx.fillStyle='gold';
    ctx.font='30px Arial';
    ctx.fillText('Wynik '+ score,180,40);
    ctx.fillText('Zasoby '+ numberOfRecources,180,80);
    let win='false';
    if(gameOver){
        var stopTImie = performance.now();
    
        ctx.fillStyle='black';
        ctx.font='60px Arial';
        ctx.fillText('KONIEC GRY ',135,330);
        timePlayer=stopTImie-startTime;
        timePlayer/=1000;
        let sec= Math.round(timePlayer);
        document.getElementById("wynik").value  = score;
        document.getElementById("czas").value  = sec;
        console.log(timePlayer);
        document.getElementById("wygrana").value  = win;
        
    }
    if(score >= winScore  && enemies.length ===0){
        var stopTImie = performance.now();
        timePlayer/=1000;
        let sec= Math.round(timePlayer);
        ctx.fillStyle='black';
        ctx.font='60px Orbitron';
        ctx.fillText('Level Zaliczony ',135,330);
        ctx.font='30px Orbitron';
        ctx.fillText('Wygrywasz z ilością '+score+' punktów',135,360);
        timePlayer=stopTImie-startTime;
        document.getElementById('wynik').value =score;
        document.getElementById('czas').value  = sec;
        win='true';
        document.getElementById('wygrana').value  = win;
       
    }
}
const card1={
    x: 10,
    y: 10,
    with: 70,
    height: 75
}
const card2={
    x: 90,
    y: 10,
    with: 70,
    height: 75
}


//functiou chose defender
function choseDefender(){
    let card1Stroke='black';
    let card2Stroke='black';
    
    if(collisoion(mouse,card1) && mouse.clicked){
        chosenDefender=1;
    }else if(collisoion(mouse,card2)){
        chosenDefender=2;
    }

    if(chosenDefender === 1 ){
        card1Stroke='gold';
        card2Stroke='black';
    }else if(chosenDefender === 2){
        card1Stroke='black';
        card2Stroke='gold';
    }else{
        card1Stroke='black';
        card2Stroke='black';
    }

    ctx.lineWidth=1;
    ctx.fillStyle='rgb(0,0,0,0.5)';
    ctx.strokeRect(card1.x,card1.y,card1.with,card1.height);
    ctx.strokeStyle=card1Stroke;
    ctx.drawImage(defender1,0,0,194,194,0,5,194/2,194/2);
    ctx.strokeRect(card2.x,card2.y,card2.with,card2.height);
    ctx.strokeStyle=card2Stroke;
    ctx.drawImage(defender2,194*14,0,194,194,80,5,194/2,194/2);

}

//class floating massages
const floatingMessages=[];
class floatingMasage{
    constructor(valueS, x, y, size, color){
        this.valueS= valueS;
        this.x=x;
        this.y= y;
        this.size=size;
        this.lifeSpan=0;
        this.color=color;
        this.oppacity=1;
    }update(){
        this.y -= 0.3;
        this.lifeSpan+= 1;
        if(this.oppacity > 0.5){
            this.oppacity -= 0.5;
        }
    }draw(){
       // console.log(this.valueS);
        ctx.globalAlpha=this.oppacity;
        ctx.fillStyle=this.color;
        ctx.font=this.size+'px Orbitron';
        ctx.fillText('!'+this.valueS,this.x,this.y);
        ctx.globalAlpha=1;
    }
}
function handleFloatingMessages(){
    for(let i=0; i< floatingMessages.length;i++){
        floatingMessages[i].update();
        floatingMessages[i].draw();
        if(floatingMessages[i].lifeSpan >= 50){
            floatingMessages.splice(i,1);
            i--;
        }
    }
}
//class enemies

const enemyTypes=[];
const enemy1= new Image();
enemy1.src='assetsgame/enemy1.png';
enemyTypes.push(enemy1);
const enemy2= new Image();
enemy2.src='assetsgame/enemy2.png';
enemyTypes.push(enemy2);
const enemy3= new Image();
enemy3.src='assetsgame/enemy3.png';
enemyTypes.push(enemy3);

class Enemy{
    constructor(verticalPosition){
        this.x=canvas.width;
        this.y= verticalPosition;
        this.width=cellSize -cellGap;
        this.height=cellSize-cellGap;
        this.speed=Math.random() * 0.2 + 0.4;
        this.movment=this.speed;
        this.health=100;
        this.maxHealth=100;
        this.enemyType=enemyTypes[Math.floor(Math.random()* enemyTypes.length)];
        this.frameX=0; 
        this.frameY=0;
        this.minFrame=0;
        this.maxFrame=4;
        this.spriteWidth=256;
        this.spriteHeight=256;
        if(this.enemyType ===enemy1){
            this.health=140;
            this.maxHealth=140;
            this.speed-=0.2;
        }else if(this.enemyType ===enemy2){
            this.health=110;
            this.maxHealth=110;
            this.speed+=0.1;
        }else if(this.enemyType ===enemy3){
            this.health=70;
            this.maxHealth=80;
            this.speed+=0.2;
        }
    }
    update(){
        this.x-= this.movment;
        if(frame % 10 ===0){
            if(this.frameX < this.maxFrame){
                this.frameX++;
            }else{
                this.frameX=this.minFrame;
            }
        }
       
    }
    draw(){
        //ctx.fillStyle = 'red';
       // ctx.fillRect(this.x,this.y,this.width,this.height);
        ctx.fillStyle = 'black';
        ctx.font= '30px Arial';
        ctx.fillText(Math.floor(this.health),this.x+15,this.y+25);
        //ctx.drawImage(img,sx,sy,sw,sh,dx,dy,dw,dh);
        ctx.drawImage(this.enemyType,this.frameX* this.spriteWidth,0,this.spriteWidth,this.spriteHeight,this.x,this.y,this.width,this.height);
    }
}
///
function handleEnemies(){
    for(let i = 0;i < enemies.length; i++){
        enemies[i].draw();
        enemies[i].update();
        
        if(enemies[i].x <0){
            gameOver=true;
        }
        if(enemies[i].health<=0){
            let ganirecources=enemies[i].maxHealth/10;
            floatingMessages.push(new floatingMasage('+'+ganirecources,enemies[i].x,enemies[i].y,30,'black'));
            floatingMessages.push(new floatingMasage('+'+ganirecources,250,50,30,'gold'));
            numberOfRecources+= ganirecources;
            score+=ganirecources;
            const findThisINDEX=enemiesPosition.indexOf(enemies[i].y);
            enemiesPosition.splice(findThisINDEX,1);
            enemies.splice(i,1);
            i--;
            //console.log(enemiesPosition);
        }
        
    }
    if(frame % enemiesInterval === 0  && score < winScore){
        let verticalPosition=Math.floor(Math.random() *5 + 1) * cellSize+cellGap;
        //console.log(verticalPosition);
        enemies.push(new Enemy(verticalPosition));
       // console.log(enemies);
        enemiesPosition.push(verticalPosition);
        if(enemiesInterval> 120){
            enemiesInterval-=20;
        }  
    }
}

//////////// fuctition work in looop
function animate(){
    ctx.clearRect(0,0,canvas.width,canvas.height)
    ctx.fillStyle = 'green';
    ctx.fillRect(0,0,controlsBar.width,controlsBar.height);
    handleGameGrid();
    handleDefenders();
    
    handleProjectiles();
    handleEnemies();
    choseDefender();
    handleRecourse();
    handleGameStatus();
    handleFloatingMessages();
    
    
    frame++;
    if(!gameOver){
        requestAnimationFrame(animate);
    }
}
animate();

function collisoion(first,second){
    if(!(first.x > second.x +second.width ||
         first.x + first.width < second.x ||
         first.y > second.y  + second.height ||
         first.y + first.height < second.y))
    {
        return true;
    };
};

window.addEventListener('resize',function(){
    canvasPosition=canvas.getBoundingClientRect();
});

