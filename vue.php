<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<div id="apps">
<form v-form name="myform" @submit.prevent="onSubmit">
    <div class="errors" v-if="myform.$submitted">
        <p v-if="myform.name.$error.required">Name is required.</p>
        <p v-if="myform.email.$error.email">Email is not valid.</p>
    </div>
    <label>
        <span>Name *</span>
        <input v-model="model.name" v-form-ctrl required name="name" />
        <p class="text-danger uk-text-small "  v-if="myform.name.$invalid"  >Please enter a valid email address</p>
			 
    </label>
    <label>
        <span>Email</span>
        <input v-model="model.email" v-form-ctrl name="email" type="email" />
    </label>
    <button type="submit">Submit</button>
</form>
<pre>{{ myform | json }}</pre>

</div>
 
        <script src="assets/scripts/plugins/moment.min.js"></script>
        <script src="assets/scripts/plugins/datetimepicker/bootstrap-datetimepicker.min.js"></script>
<?php include("./_library_/_includes_/js.php"); ?>

          <script>
            //Time
            if ($('.time-picker')[0]) {
                $('.time-picker').datetimepicker({
                    format: 'LT'
                });
            }
        </script>
        
         <script>


 


var vm = new Vue({
  el: "#apps",
  ready : function() {
  },
 data : {
    
    
  },
 
})

</script>