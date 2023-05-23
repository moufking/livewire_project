<div class="container mb-5">
    <ul class="list-group">
        <li class="list-group-item">
                <img src="{{$details['image']->thumb}}" alt="">
                {{$details['name']}}
        </li>
        <li class="list-group-item">Market cap rank :  {{$details['market_cap_rank']}}</li>
        <li class="list-group-item">Sentiment votes down percentage : {{$details['sentiment_votes_down_percentage']}} </li>
        <li class="list-group-item">Nombre de téléscripteur :  {{count($details['tickers'])}} </li>
        <li class="list-group-item">Liste des catégories

                @foreach($details['categories'] as $categorie)
                        <span class="btn btn-primary">{{$categorie}}</span>
                @endforeach
        </li>
    </ul>
</div>


