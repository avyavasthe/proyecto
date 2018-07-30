@extends('index')
@section('contenido')



  <h1>Lista de Usuarios</h1>

<br>

<div class="card-deck">
  @foreach ($usuarios as $usu)
    @php
    $email = $usu->name;
    $hash = md5(strtolower(trim($email)));
    @endphp

 <br>

    <div class="card" >
      <img class="card-img-top" src="https://unicornify.pictures/avatar/{{$hash}}?s=640" alt="Card image cap">
      <div class="card-body">
        <h5 class="card-title">{{$usu->name}}</h5>


        <div class="progress">

          <div class="progress-bar bg-warning" role="progressbar" style="width:{{$usu->ranking}}%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">Ranking </div>
        </div><br>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                     Contactar
                   </button>

                   <!-- Modal -->
                   <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                     <div class="modal-dialog" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLabel">Contacto</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>



                         <div class="modal-body">

                           <form method="POST" action="/usuarios{{1}}" >
                             {{ csrf_field() }}
                            <input type="hidden" name="email" value="{{Auth::user()->email}}">
                              <input type="hidden" name="idre" value="{{$usu->id}}">
                             <input type="hidden" name="idEnvio" value="{{Auth::user()->id}}">
                               <label for="mensaje" class="col-sm-2 col-form-label">Mensaje</label>
                                 <div class="col-sm-9">
                               <textarea class="form-control" rows="4"  name="mensaje" id="mensaje"></textarea>
                                 </div>




                         <div class="modal-footer">
                           <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                           <button type="submit" class="btn btn-primary">Enviar</button>
                         </div></form></div>
                       </div>
                     </div>
                   </div>
      </div>
    </div>








  @endforeach


</div>



@endsection
