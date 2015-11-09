<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">

  <script type='text/javascript' src='http://code.jquery.com/jquery-1.9.1.js'></script>
<link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
<script src="assets/scripts/vendors.js"></script>

<script type='text/javascript'>//<![CDATA[ 
$(window).load(function(){
$('[data-load-remote]').on('click',function(e) {
    e.preventDefault();
    var $this = $(this);
    var remote = $this.data('load-remote');
    if(remote) {
        $($this.data('remote-target')).load(remote);
    }
});

$('#openBtn').click(function(){
  $('#myModal').modal({show:true})
});

});//]]>  

</script>


</head>
<body>
  <a href="#myModal" role="button" class="btn" data-toggle="modal" data-load-remote="http://fiddle.jshell.net/Sherbrow/bHmRB/0/show/" data-remote-target="#myModal .modal-body">Btn 1</a>    <a href="#myModal" role="button" class="btn" data-toggle="modal" data-load-remote="http://fiddle.jshell.net/Sherbrow/bHmRB/1/show/" data-remote-target="#myModal .modal-body">Btn 2</a>
<a href="#myModal" role="button" class="btn" data-toggle="modal" data-load-remote="http://fiddle.jshell.net/Sherbrow/bHmRB/2/show/" data-remote-target="#myModal .modal-body">Btn 3</a>
<a href="#myModal" role="button" class="btn" data-toggle="modal" data-load-remote="members.php" data-remote-target="#myModal .modal-body">Btn 4</a>

<a data-toggle="modal" href="#myModal" class="btn btn-primary">Launch modal</a>



<!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Modal title</h4>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->    

</body>
</html>