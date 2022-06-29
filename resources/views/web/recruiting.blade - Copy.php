@extends('web.layouts.main')
@section('content')
<section class="sports-sec">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="sports-blk">
                    <table>
                        <tr>
                            <th>Rank</th>
                            <th>Player</th>
                            <th>Pos</th>
                            <th>Ht</th>
                            <th>Wt</th>
                            <th>BT</th>
                            <th>HS</th>
                            <th>Hometown</th>
                            <th>St</th>
                            <th>College Interests</th>
                        </tr>

                        <tr>
                            <td><i class="fa fa-check" aria-hidden="true"></i> Subscribe</td>
                            <td>
                                <a href="sports-detail.html">
                                    <div class="walter-image">
                                        <img src="images/walter-ford.jpg" />
                                        <h4>Walter Ford</h4>
                                    </div>
                                </a>
                            </td>
                            <td>SS</td>
                            <td>6-2</td>
                            <td>190</td>
                            <td>R-R</td>
                            <td>Braswell</td>
                            <td>Savannah</td>
                            <td>TX</td>
                            <td>
                                <h3>Alabama, Arkansas, Oklahoma State, Texas A&M, Texas Tech, Vanderbilt</h3>
                                <h5>Committed to Arkansas</h5>
                            </td>
                        </tr>

                        <tr>
                            <td><i class="fa fa-check" aria-hidden="true"></i> Subscribe</td>
                            <td>
                                <a href="sports-detail.html">
                                    <div class="walter-image">
                                        <img src="images/ross-highfill.jpg" />
                                        <h4>Ross Highfill</h4>
                                    </div>
                                </a>
                            </td>
                            <td>SS</td>
                            <td>6-2</td>
                            <td>190</td>
                            <td>R-R</td>
                            <td>Braswell</td>
                            <td>Savannah</td>
                            <td>TX</td>
                            <td>
                                <h3>Alabama, Arkansas, Oklahoma State, Texas A&M, Texas Tech, Vanderbilt</h3>
                                <h5>Committed to Arkansas</h5>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
