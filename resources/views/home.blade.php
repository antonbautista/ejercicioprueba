<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />


<div class="container mt-5">

   <div class="mb-5">
   <label for="">Seleccionar fecha</label>
   <input id="datepicker" width="276" />
    <script>
        $('#datepicker').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd',
            startDate: '-3d'
        });

        $('#datepicker').change(function() {
        var selected_date=$('#datepicker').val();
        window.location.replace("/home/"+selected_date);

        });
       
    </script>
   
   </div>


<table id="example" class="table table-striped table-bordered" style="width:100%">

        <thead>
            <tr>
                <th style='width: 5%;'></th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Puesto</th>
                <th>Grupo</th>
                <th>Asistencia</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
                @foreach($empleados as $emp)    
                        <tr>
                            <td>
                                @if($emp->asistencia)
                                   <input type="checkbox" style="width:40px;height:40px;" checked disabled>
                                @else
                                    <input type="checkbox" id="chx{{$emp->id}}" style="width:40px;height:40px;" onclick="test('{{ $emp->id }}')" >
                                @endif
                            
                            </td>
                            <td>
                                {{ $emp->nombre }}
                                {{ $emp->apellidopaterno }}
                                {{ $emp->apellidomaterno }}    
                            </td>
                            <td>{{ $emp->edad }}</td>
                            <td>{{ $emp->puesto }}</td>
                            <td>{{ $emp->nombregrupo }}</td>
                            <td>{{ $emp->asistencia }}</td>
                            <td>{{ $emp->created_at }}</td>
                        </tr>
                @endforeach   

        </tbody>
    </table>
    <button type="button" class="btn btn-primary" id="myajax" >Guardar Asistencias</button>
    <a class="btn btn-secondary" href="/registrar" role="button">Registrar nuevo empleado</a>
</div>


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>  
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script>
        let asistencia=[];
        $(document).ready(function() {
            //$('#example').DataTable();
            var table = $('#example').DataTable();
 
        } );

        function test(t){
            var check=$('#chx'+t).is(":checked") ? 1:0;
            //alert(JSON.stringify(check));
            let dato={
                "id":t,
                "asistencia":check
            };
            asistencia.push(dato);
        }
        
    </script>

<script type = "text/javascript">
         
         $('#myajax').click(function(){
            $.ajax({
                type:'post',
                url:'/asistencias',
                data:{"lista":asistencia},
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success:function(data){
                   alert("Registro Existoso");
                   location.reload();
                    //$("#msg").html(data.msg);
                }
            });
            //we will send data and recive data fom our AjaxController
            //alert("im just clicked click me");
            /*$.ajax({
               url:'http://localhost:81/JSON.stringify(request)s',
               data:{'name':"luis"},
               type:'post',
               success:  function (response) {
                  alert(response);
               },
               statusCode: {
                  404: function() {
                     alert('web not found');
                  }
               },
               error:function(x,xs,xt){
                  //window.open(JSON.stringify(x));
                  //alert('error: ' + JSON.stringify(x) +"\n error string: "+ xs + "\n error throwed: " + xt);
               }
            });*/
             });
       </script>
       <script>
        $(document).off('.datepicker.data-api');

       </script>