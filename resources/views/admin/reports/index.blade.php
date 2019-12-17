@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">

                    <h4>Report on the Number of Conducted Consultancy Services Annually <small>Provided by DOST XI to SETUP Cooperators</small></h4>

                </div>
                <div class="panel-body">

                    <div class="box-header with-border">

                        <h5>Please select the inclusive years.</h5>

                    </div>


                    <form action="{{ route("admin.reports.view") }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row" >
                            <div class="col-md-4" style="padding-left: 20px;">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="prov">Province:</label>
                                        <select name="prov" id="prov" class="form-control" >
                                            <option value="Davao de Oro">Davao de Oro</option>
                                            <option value="Davao City">Davao City</option>
                                            <option value="Davao Del Norte">Davao Del Norte</option>
                                            <option value="Davao Del Sur">Davao Del Sur</option>
                                            <option value="Davao Oriental">Davao Oriental</option>
                                            <option value="Region XI">All in Region XI</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="box-body">
                                    <div class="form-group">

                                        <label for="from">FROM Year:</label>

                                        <select name="from" id="from" class="form-control" >
                                            <option value="2040">2040</option>
                                            <option value="2039">2039</option>
                                            <option value="2038">2038</option>
                                            <option value="2037">2037</option>
                                            <option value="2036">2036</option>
                                            <option value="2035">2035</option>
                                            <option value="2034">2034</option>
                                            <option value="2033">2033</option>
                                            <option value="2032">2032</option>
                                            <option value="2031">2031</option>
                                            <option value="2030">2030</option>
                                            <option value="2029">2029</option>
                                            <option value="2028">2028</option>
                                            <option value="2027">2027</option>
                                            <option value="2026">2026</option>
                                            <option value="2025">2025</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019">2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010" selected>2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3" >
                                <div class="box-body">
                                    <div class="form-group">

                                        <label for="to">TO Year:</label>

                                        <select name="to" id="to" class="form-control" >
                                            <option value="2040">2040</option>
                                            <option value="2039">2039</option>
                                            <option value="2038">2038</option>
                                            <option value="2037">2037</option>
                                            <option value="2036">2036</option>
                                            <option value="2035">2035</option>
                                            <option value="2034">2034</option>
                                            <option value="2033">2033</option>
                                            <option value="2032">2032</option>
                                            <option value="2031">2031</option>
                                            <option value="2030">2030</option>
                                            <option value="2029">2029</option>
                                            <option value="2028">2028</option>
                                            <option value="2027">2027</option>
                                            <option value="2026">2026</option>
                                            <option value="2025">2025</option>
                                            <option value="2024">2024</option>
                                            <option value="2023">2023</option>
                                            <option value="2022">2022</option>
                                            <option value="2021">2021</option>
                                            <option value="2020">2020</option>
                                            <option value="2019" selected>2019</option>
                                            <option value="2018">2018</option>
                                            <option value="2017">2017</option>
                                            <option value="2016">2016</option>
                                            <option value="2015">2015</option>
                                            <option value="2014">2014</option>
                                            <option value="2013">2013</option>
                                            <option value="2012">2012</option>
                                            <option value="2011">2011</option>
                                            <option value="2010">2010</option>
                                            <option value="2009">2009</option>
                                            <option value="2008">2008</option>
                                            <option value="2007">2007</option>
                                            <option value="2006">2006</option>
                                            <option value="2005">2005</option>
                                            <option value="2004">2004</option>
                                            <option value="2003">2003</option>
                                            <option value="2002">2002</option>
                                            <option value="2001">2001</option>
                                            <option value="2000">2000</option>
                                            <option value="1999">1999</option>
                                            <option value="1998">1998</option>
                                            <option value="1997">1997</option>
                                            <option value="1996">1996</option>
                                            <option value="1995">1995</option>
                                            <option value="1994">1994</option>
                                            <option value="1993">1993</option>
                                            <option value="1992">1992</option>
                                            <option value="1991">1991</option>
                                            <option value="1990">1990</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2" style="padding-right: 20px;">

                                <div class="box-body">
                                    <label for="to">Confirm:</label>

                                    <button type="submit" name="submButton" id="submButton" class="btn btn-block btn-success btn-md">GO</button>

                                    <!-- <button style="width: 157px; height: 46px; color: white;" type="button" class="btn btn-block btn-warning btn-lg">Restart</button> -->

                                </div>

                            </div>
                        </div>
                    </form>


                </div>
            </div>

        </div>
    </div>
</div>
@endsection