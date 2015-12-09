<?php
  require_once('templates/header.php');
  if (empty($_SESSION['login']))
  {
    $_SESSION['msg'] = "Vous devez être connecte pour accedez a cette page";
    header('location: account.php');
  }

  $req = $bdd->prepare('SELECT * FROM renders');          
  $req->execute();
   $resultat=($req->fetchAll());

    ?>
<body>
  <div class="part">
    <div class="camagru">
      <h2>Ton montage</h2>
      <hr class="fancy"/>

<canvas id="canvas" class="cadre floatl" width="640" height="480" ondrop="drop(event)" ondragover="enableDrop(event)" autoplay></canvas>
<div class="image">
  <?php
     foreach ($resultat as $key => $value) {
   
   ?>
  <img id="<?php echo $value['id']; ?>" src="<?php echo $value['url']; ?>" class="cadre icone" draggable="true" ondragstart="drag(event)" >
  <?php } ?>
</div>
<div class="boutton">
<button id="delete" class="btn btn-orange">Supprimer</button>
<button id="save" class="btn btn-default btn-center">Save</button>
</div>
</div>

<div class="last">
  <h2>Derniere creation</h2>
  <hr class="fancy"/>

  <?php
    $requete = $bdd->prepare("SELECT * FROM image ORDER BY id DESC LIMIT 6");
    $requete->execute();
    $res = $requete->fetchAll();
    foreach ($res as $key => $value) {
      ?>
      <img src="<?php echo $value['url_image'] ?>" alt="" class="cadre">
      <?php
    }
  ?>
</div>
</div>
<script type="text/javascript">

/*
window.onload = function() {
    if(!window.location.hash) {
        window.location = window.location + '#loaded';
        window.location.reload();
    }
}*/
  var cam = "<?php echo $_SESSION["file"]; ?>" ; 
function drag(evt)
{
  evt.dataTransfer.setData("text",evt.target.id);// to access DataTranfer interface
}

function enableDrop(evt)
{
  evt.preventDefault();// to allow elements to be dropped at destination
}
function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        return {
          x: evt.clientX - rect.left,
          y: evt.clientY - rect.top
        };
}


function drop(evt)
{

  evt.preventDefault();
  var dragged_item=evt.dataTransfer.getData("text");
  var imge = document.getElementById(dragged_item).getAttribute("src");
  base_image = new Image();

  base_image.src = imge;
  base_image.onload = function(){
    var canvas = document.getElementById("canvas");
    var mousePos = getMousePos(canvas, evt);
    var context = canvas.getContext("2d");
    s.addShape(new Shape(mousePos.x - 10,mousePos.y - 10,base_image.width,base_image.height, base_image, true));
  }
}
  
function Shape(x, y, w, h, fill, drag) {
  // This is a very simple and unsafe constructor. All we're doing is checking if the values exist.
  // "x || 0" just means "if there is a value for x, use that. Otherwise use 0."
  // But we aren't checking anything else! We could put "Lalala" for the value of x 
  this.x = x || 0;
  this.y = y || 0;
  this.w = w || 1;
  this.h = h || 1;
  this.drag = drag;
  this.fill = fill;
}

// Draws this shape to a given context

Shape.prototype.draw = function(ctx) {
  ctx.drawImage(this.fill, this.x, this.y, this.w, this.h);
}

// Determine if a point is inside the shape's bounds
Shape.prototype.contains = function(mx, my) {
  // All we have to do is make sure the Mouse X,Y fall in the area between
  // the shape's X and (X + Width) and its Y and (Y + Height)
  return  (this.x <= mx) && (this.x + this.w >= mx) &&
          (this.y <= my) && (this.y + this.h >= my);
}

function CanvasState(canvas) 
{
  // **** First some setup! ****
  
  this.canvas = canvas;
  this.width = canvas.width;
  this.height = canvas.height;
  this.ctx = canvas.getContext('2d');
  // This complicates things a little but but fixes mouse co-ordinate problems
  // when there's a border or padding. See getMouse for more detail
  var stylePaddingLeft, stylePaddingTop, styleBorderLeft, styleBorderTop;
  if (document.defaultView && document.defaultView.getComputedStyle) {
    this.stylePaddingLeft = parseInt(document.defaultView.getComputedStyle(canvas, null)['paddingLeft'], 10)      || 0;
    this.stylePaddingTop  = parseInt(document.defaultView.getComputedStyle(canvas, null)['paddingTop'], 10)       || 0;
    this.styleBorderLeft  = parseInt(document.defaultView.getComputedStyle(canvas, null)['borderLeftWidth'], 10)  || 0;
    this.styleBorderTop   = parseInt(document.defaultView.getComputedStyle(canvas, null)['borderTopWidth'], 10)   || 0;
  }
  // Some pages have fixed-position bars (like the stumbleupon bar) at the top or left of the page
  // They will mess up mouse coordinates and this fixes that
  var html = document.body.parentNode;
  this.htmlTop = html.offsetTop;
  this.htmlLeft = html.offsetLeft;

  // **** Keep track of state! ****
  
  this.valid = false; // when set to false, the canvas will redraw everything
  this.shapes = [];  // the collection of things to be drawn
  this.dragging = false; // Keep track of when we are dragging
  // the current selected object. In the future we could turn this into an array for multiple selection
  this.selection = null;
  this.dragoffx = 0; // See mousedown and mousemove events for explanation
  this.dragoffy = 0;
  
  // **** Then events! ****
  
  // This is an example of a closure!
  // Right here "this" means the CanvasState. But we are making events on the Canvas itself,
  // and when the events are fired on the canvas the variable "this" is going to mean the canvas!
  // Since we still want to use this particular CanvasState in the events we have to save a reference to it.
  // This is our reference!
  var myState = this;
  
  //fixes a problem where double clicking causes text to get selected on the canvas
  canvas.addEventListener('selectstart', function(e) { e.preventDefault(); return false; }, false);
  // Up, down, and move are for dragging
  canvas.addEventListener('mousedown', function(e) {
    var mouse = myState.getMouse(e);
    var mx = mouse.x;
    var my = mouse.y;
    var shapes = myState.shapes;
    var l = shapes.length;
    for (var i = l-1; i >= 0; i--) {
      if (shapes[i].contains(mx, my)) {
        var mySel = shapes[i];
        // Keep track of where in the object we clicked
        // so we can move it smoothly (see mousemove)
        myState.dragoffx = mx - mySel.x;
        myState.dragoffy = my - mySel.y;
        if (mySel.drag == false)
        {
          myState.selection = null;
        }
        else
        {
          myState.dragging = true;
          myState.selection = mySel;
          myState.valid = false;
        }
        
        return;
      }
    }
    // havent returned means we have failed to select anything.
    // If there was an object selected, we deselect it
    if (myState.selection) {
      myState.selection = null;
      myState.valid = false; // Need to clear the old selection border
    }
  }, true);
  canvas.addEventListener('mousemove', function(e) {
    if (myState.dragging){
      var mouse = myState.getMouse(e);
      // We don't want to drag the object by its top-left corner, we want to drag it
      // from where we clicked. Thats why we saved the offset and use it here
      myState.selection.x = mouse.x - myState.dragoffx;
      myState.selection.y = mouse.y - myState.dragoffy;   
      myState.valid = false; // Something's dragging so we must redraw
    }
  }, true);
  canvas.addEventListener('mouseup', function(e) {
    myState.dragging = false;
  }, true);
  // double click for making new shapes
  
  // **** Options! ****
  
  this.selectionColor = '#CC0000';
  this.selectionWidth = 2;  
  this.interval = 30;
  setInterval(function() { myState.draw(); }, myState.interval);
}

CanvasState.prototype.addShape = function(shape) {
  this.shapes.push(shape);
  this.valid = false;
}

CanvasState.prototype.clear = function() {
  this.ctx.clearRect(0, 0, this.width, this.height);
}

// While draw is called as often as the INTERVAL variable demands,
// It only ever does something if the canvas gets invalidated by our code
CanvasState.prototype.draw = function() {
  // if our state is invalid, redraw and validate!
  if (!this.valid) {
    var ctx = this.ctx;
    var shapes = this.shapes;
    this.clear();
    
    // ** Add stuff you want drawn in the background all the time here **
    
    // draw all shapes
    var l = shapes.length;
    for (var i = 0; i < l; i++) {
      var shape = shapes[i];
      // We can skip the drawing of elements that have moved off the screen:
      if (shape.x > this.width || shape.y > this.height ||
          shape.x + shape.w < 0 || shape.y + shape.h < 0) continue;
      shapes[i].draw(ctx);
    }
    
    // draw selection
    // right now this is just a stroke along the edge of the selected Shape
    if (this.selection != null) {
      var mySel = this.selection;

      ctx.drawImage(mySel.fill, mySel.x,mySel.y,mySel.w,mySel.h);
    }
    
    // ** Add stuff you want drawn on top all the time here **
    
    this.valid = true;
  }
}


// Creates an object with x and y defined, set to the mouse position relative to the state's canvas
// If you wanna be super-correct this can be tricky, we have to worry about padding and borders
CanvasState.prototype.getMouse = function(e) {
  var element = this.canvas, offsetX = 0, offsetY = 0, mx, my;
  {
    do {
  // Compute the total offset
  if (element.offsetParent !== undefined) 
      offsetX += element.offsetLeft;
      offsetY += element.offsetTop;
    } while ((element = element.offsetParent));
  }

  // Add padding and border style widths to offset
  // Also add the <html> offsets in case there's a position:fixed bar
  offsetX += this.stylePaddingLeft + this.styleBorderLeft + this.htmlLeft;
  offsetY += this.stylePaddingTop + this.styleBorderTop + this.htmlTop;

  mx = e.pageX - offsetX;
  my = e.pageY - offsetY;
  
  // We return a simple javascript object (a hash) with x and y defined
  return {x: mx, y: my};
}

// If you dont want to use <body onLoad='init()'>
// You could uncomment this init() reference and place the script reference inside the body tag
//init();

var imj = new Image();
imj.src = cam;
  var s = new CanvasState(document.getElementById('canvas'));

imj.onload = function()
{
  s.addShape(new Shape(0,0,imj.width,imj.height, imj, false)); // The default is gray
 } // Lets make some partially transparent

</script> 
<script type="text/javascript">
document.getElementById("delete").addEventListener("click", function(){
  location.reload();
})
  document.getElementById("save").addEventListener("click", function() {
    var canvas = document.getElementById("canvas");
    var canvasData = canvas.toDataURL("image/png");
    var ajax = new XMLHttpRequest();
    ajax.open("POST",'camagru.php',false);
    ajax.setRequestHeader('Content-Type', 'application/upload');
    ajax.send(canvasData);
    document.location.replace('index.php');

   
  });

</script>
<?php
if (isset($GLOBALS["HTTP_RAW_POST_DATA"]))
{
   // Get the data
  $imageData=$GLOBALS['HTTP_RAW_POST_DATA'];

  // Remove the headers (data:,) part.
  // A real application should use them according to needs such as to check image type
  $filteredData=substr($imageData, strpos($imageData, ",")+1);

  // Need to decode before saving since the data we received is already base64 encoded
  $unencodedData=base64_decode($filteredData);

  //echo "unencodedData".$unencodedData;

  // Save file. This example uses a hard coded filename for testing,
  // but a real application can specify filename in POST variable
  $name = "montages/".time().rand().".png";

  $fp = fopen( $name, 'wb' );
  fwrite( $fp, $unencodedData);
  fclose( $fp );
  $req = $bdd->prepare("INSERT INTO image(url_image, date, id_users) VALUES(:url, :date, :id_users)");
  $id = $bdd->prepare("SELECT id FROM users WHERE login = ?");
  $id->execute(array($_SESSION['login']));
  $resultat=($id->fetch());
  $resultat = $resultat['id'];
  $req->execute(array(
    'url' => $name,
    'date' => date("Y-m-d", time()),
    'id_users' => $resultat
    ));
  $_SESSION['success'] = "OK";

}
?>



<?php
require_once('templates/footer.php');
?>
