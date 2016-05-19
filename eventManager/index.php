<?php include('includes/loader.php'); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ajax Full Featured Calendar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link href="css/main.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/ui-lightness/jquery-ui.css" rel="stylesheet">
    <link href="css/fullcalendar.css" rel="stylesheet">
    <link href="lib/colorpicker/css/colorpicker.css" rel="stylesheet">
    <link href="lib/validation/css/validation.css" rel="stylesheet">
    
    <link href="lib/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet">
	    
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-default navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="navbar-brand" href="index.php">Events Calendar</a>
        </div>
      </div>
    </div>

    <div class="container">
		
      <a href="add_event.php" class="btn btn-default pull-right" style="margin-bottom: 20px;">Add Event</a>
       
      <div class="clearfix"></div>
      
       <!-- Filter by Category -->
      <?php if($calendar->getCategories() !== false) { ?>
      <form id="filter-category">
          <select>
            <option <?php if(isset($_SESSION['filter']) && $_SESSION['filter'] == 'all-fields'): echo 'selected '; endif; ?>value="all-fields">All</option>
            <?php foreach($calendar->getCategories() as $categorie) { ?>
            <option <?php if(isset($_SESSION['filter']) && $_SESSION['filter'] == $categorie): echo 'selected '; endif; ?>value="<?php echo $categorie; ?>"><?php echo $categorie; ?></option>
            <?php } ?>
          </select>
      </form>
      <?php } ?>
        
      <div class="box">
        <div class="header"><h4>Calendar</h4></div>
        <div class="content"> 
            <div id="calendar"></div>
        </div> 
    </div>

    </div> <!-- /container -->
    
	<!-- Modal View Event -->
    <div id="cal_viewModal" class="modal fade">
    	<div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <a href="#" class="btn btn-danger" data-option="remove">Delete</a>
            <a href="#" class="btn btn-info" data-option="edit">Edit</a>
            <a href="#" class="btn btn-warning" data-option="export">Export</a>
        	<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
        </div>
        </div>
        </div>
    </div>
    
    <!-- Modal Edit Event -->
    <div id="cal_editModal" class="modal fade">
    	<div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" data-option="save">Save Changes</a>
        	<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
        </div>
        </div>
        </div>
    </div>
    
    <!-- Modal QuickSave Event -->
    <div id="cal_quickSaveModal" class="modal fade">
    	<div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
            <a href="#" class="btn btn-primary" data-option="quickSave">Add Event</a>
        	<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
        </div>
        </div>
        </div>
    </div>
    
    <!-- Modal Delete Prompt -->
    <div id="cal_prompt" class="modal fade">
    	<div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body"></div>
        <div class="modal-footer">
        	<a href="#" class="btn btn-danger" data-option="remove-this">Delete this</a>
            <a href="#" class="btn btn-danger" data-option="remove-repetitives">Delete all</a>
        	<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
        </div>
        </div>
        </div>
    </div>
    
    <!-- Modal Edit Prompt -->
    <div id="cal_edit_prompt_save" class="modal fade">
    	<div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body-custom"></div>
        <div class="modal-footer">
        	<a href="#" class="btn btn-info" data-option="save-this">Save this</a>
            <a href="#" class="btn btn-info" data-option="save-repetitives">Save all</a>
        	<a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
        </div>
        </div>
        </div>
    </div>
        
    <!-- javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script src="js/gcal.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/jquery.calendar.js"></script>
    <script src="lib/colorpicker/bootstrap-colorpicker.js"></script>
    <script src="lib/validation/jquery.validationEngine.js"></script>
    <script src="lib/validation/jquery.validationEngine-en.js"></script>
    
    <script src="lib/timepicker/jquery-ui-sliderAccess.js"></script>
    <script src="lib/timepicker/jquery-ui-timepicker-addon.min.js"></script>
    
    <script src="js/custom.js"></script>
    
    <!-- call calendar plugin -->
    <script type="text/javascript">
		$().FullCalendarExt({
			calendarSelector: '#calendar',
			quickSaveCategory: '<label>Category: </label><select name="categorie"><?php foreach($calendar->getCategories() as $categorie) { ?> <option value="<?php echo $categorie?>"><?php echo $categorie; ?></option><?php } ?></select>',
		});
	</script>

  </body>
</html>
