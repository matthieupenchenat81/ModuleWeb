<legend>Résultat de ma recherche</legend>
    <select multiple="multiple" class="multiple" id="toadd" name="toadd[]">
        @foreach($oeuvres as $oeuvre)
            <option data-img-src='http://www.augustins.org/documents/10180/156407/{{$oeuvre->image}}' value='{{$oeuvre->id}}'></option>
        @endforeach
    </select>

{!! $oeuvres->render() !!}

<button type="submit" class="btn btn-primary">Ajouter à la liste courante</button>