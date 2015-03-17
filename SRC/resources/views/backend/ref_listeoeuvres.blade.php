<legend>Résultat de ma recherche</legend>
    <select multiple="multiple" class="multiple" id="toadd" name="toadd[]">
        @foreach($oeuvres as $oeuvre)
            <option data-img-src='/image/200/{{$oeuvre->image}}' value='{{$oeuvre->id}}'></option>
        @endforeach
    </select>
<div class="text-center">
{!! $oeuvres->render() !!}
</div>
<button type="submit" class="btn btn-primary">Ajouter à la liste courante</button>
