@extends('web.layouts.main')
@section('content')
<section class="sports-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="sports-blk">
                    <table>
                        <tr>
                            <th>Player</th>
                            <th>Sports</th>
                            <th>Pos</th>
                            <th>Ht</th>
                            <th>Wt</th>
                            <th>B-T</th>
                            <th>HS</th>
                            <th>Country</th>
                        </tr>
                        @foreach ($player as $ply)
                        <tr>
                            @if(($pic=$model['user']::where(['id'=>$ply->user_id])->pluck('profile_pic')->first()) != null)
                            @php $path = $pic; @endphp
                            @else
                            @php $path = "images/no-img.png"; @endphp
                            @endif
                            <td>
                                <a href="{{route('player_profile',$ply->id)}}">
                                    <div class="walter-image">
                                        <img src="{{asset($path)}}" />
                                        <h4>{{$ply->name}}</h4>
                                    </div>
                                </a>
                            </td>
                            <td>{{$spt=$model['sports']::where(['id'=>$ply->sports])->pluck('name')->first();}}</td>
                            <td>{{$position=$model['position']::where(['id'=>$ply->primary_position])->pluck('name')->first();}}</td>
                            <td>{{$ply->height}}</td>
                            <td>{{$ply->weight}}</td>
                            <td>{{$ply->bats}}-{{$ply->throws}}</td>
                            <td>{{$ply->highschool}}</td>
                            <td>{{$cnt=$model['country']::where(['id'=>$ply->country])->pluck('name')->first();}}</td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
