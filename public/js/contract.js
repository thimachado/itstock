
   $(function () {
     $('#datepickerstart').datepicker({ format: 'dd-mm-yyyy' });
   });

   $(function () {
     $('#datepickerexpiration').datepicker({ format: 'dd-mm-yyyy' });
   });

   $(function () {
     $('#datepickerwarning').datepicker({ format: 'dd-mm-yyyy' });
   });

   $(function () {
     $('#datepickerultimaparcela').datepicker({ format: 'dd-mm-yyyy' });
   });
   
    var selDiv = "";	
	document.addEventListener("DOMContentLoaded", init, false);
	function init() {
		document.querySelector('#files').addEventListener('change', handleFileSelect, false);
		selDiv = document.querySelector("#selectedFiles");
  }
  
	function handleFileSelect(e) {
		if(!e.target.files) return;
    document.getElementById("selectedFiles").innerHTML ="";
		var files = e.target.files;
    if(files.length <= 5){
		for(var i=0; i<files.length; i++) {
      var f = files[i];
     // document.getElementById("selectedFiles").innerHTML += f.name + "<br/>";
			selDiv.innerHTML += f.name + "<br/>";
      document.getElementById("alert").innerHTML = "<p class="+"text-danger" +">  </p>";
		}
    }else{
      document.getElementById("alert").innerHTML  = "<p class="+"text-danger" +"> Você pode upar no máximo 5 arquivos."+
      " Você tentou upar " + files.length + " arquivos. </p>";
      document.getElementById("files").value = "";
  }
}

$(document).on('click', '.btn-dell',function(e){
  var str = $(this).val();
  var [id, name] = str.split(' @ ');
  var url = '/deleteattach/'+id+'/'+name;
  console.log(url);
  
  $.ajax({
     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
   },
     type: 'post',
     url:url,
     data: {id:id},
     dataType: 'json',
     success: function(data)
     {
         document.getElementById('id'+ id).remove();
         document.getElementById('attachid'+ id).remove();
         console.log('tr.id'+ id);
         console.log('attachid'+ id);
         var count = $('input[name="attachid[]"]').length;
         if (count > 0) 
         { 
           console.log("existe");
          document.getElementById("divatt").innerHTML  =  "<input type=" + "file " +  " id=" + "files " + "name= " + "attachments[]" + " multiple />";
         }else{
           console.log("não existe");
           document.getElementById("divatt").innerHTML  =  "<input type=" + "file " +  " id=" + "files " + "name= " + "attachments[]" + " multiple required autofocus />";
         }
     }
  
  })
  })