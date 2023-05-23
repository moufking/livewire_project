<div>
    {{--}}
    <div class="progress" role="progressbar" aria-label="Warning example" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-warning" style="width: {{$brightness}}%"></div>
    </div>
    --}}





    <div class="input-group mt-5">
        <form wire:submit.prevent = "search">
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">Search</span>
                <input type="text"  wire:model="name" class="form-control" placeholder="Enter name coin or market_cap" aria-label="Username" aria-describedby="basic-addon1">
            </div>
        </form>

    </div>

    @if(count($details)> 0)
        @include('livewire.details')
    @endif

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" wire:click="sort('name')">Name
                @if($type_order ==='asc')
                    <i class="fas fa-arrow-down"></i>
                @else
                    <i class="fas fa-arrow-up"></i>
                @endif
            </th>
            <th scope="col" wire:click="sort('current_price')">Price
                @if($type_order ==='asc')
                    <i class="fas fa-arrow-down"></i>
                @else
                    <i class="fas fa-arrow-up"></i>
                @endif
            </th>
            <th scope="col" wire:click="sort('market_cap')">Market Cap
                @if($type_order ==='asc')
                    <i class="fas fa-arrow-down"></i>
                @else
                    <i class="fas fa-arrow-up"></i>
                @endif
            </th>
            <th scope="col" wire:click="sort('market_cap_rank')">Market Cap Rank
                @if($type_order ==='asc')
                    <i class="fas fa-arrow-down"></i>
                @else
                    <i class="fas fa-arrow-up"></i>
                @endif
            </th>
            <th scope="col" wire:click="sort('total_volume')">Volume
                @if($type_order ==='asc')
                    <i class="fas fa-arrow-down"></i>
                @else
                    <i class="fas fa-arrow-up"></i>
                @endif
            </th>

            <th>Action</th>
        </tr>
        </thead>
        <tbody>


        @foreach($responses as $key=> $response)
            @if(gettype($response) == 'object')
                <tr>
                    <td scope="row">
                        {{$key}}
                    </td>
                    <td>
                        <img src="{{$response->image}}" alt="" height="20px" width="20px">
                        {{$response->name}}
                    </td>
                    <td>{{$response->current_price}}</td>
                    <td>{{$response->market_cap}}</td>
                    <td>{{$response->market_cap_rank}}</td>
                    <td>{{$response->total_volume}}</td>
                    <td>
                        <button class="btn btn-primary" wire:click="detail('{{$response->id}}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>

                </tr>
            @elseif(gettype($responses) ==='array')
                <tr>
                    <td scope="row">
                        {{$key}}
                    </td>
                    <td>
                        <img src="{{$response['image']}}" alt="" height="20px" width="20px">
                        {{$response['name']}}
                    </td>
                    <td>  {{$response['current_price']}} </td>
                    <td>{{$response['market_cap']}} </td>
                    <td> {{$response['market_cap_rank']}} </td>
                    <td>{{{$response['total_volume']}}}</td>
                    <td>
                        <button class="btn btn-primary">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            @endif
        @endforeach

        </tbody>
    </table>

    {{--
    <div>
        <button wire:click="off" class="btn btn-danger">off</button>
        <button wire:click="decrement" class="btn btn-secondary"  @if($brightness== 0 ) disabled @endif >-</button>
        <button wire:click="increment" class="btn btn-primary" @if($brightness>90) disabled @endif>+</button>
        <button wire:click="on" class="btn btn-primary">On</button>
    </div>
    --}}
</div>
