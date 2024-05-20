@extends('layouts.app')
@extends('layouts.navBarAdmin')
@extends('menu.menu')
@section('content')


<div class="content-wrapper">
    <div class="row rowFixed">
        <div class="col-12">
            <div class="card m-5">
                <div class="card-header">
                    <h3 class="card-title titleModule">Products Graphics</h3> 
                   
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    
                   

                    <div class="card card-success"  id="cardBarChart">
                        <div class="card-header">
                          <h3 class="card-title">Bar Chart</h3>
                  
                          <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                              <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                        </div>
                        <div class="card-body">
                          <div class="chart">
                            <div id="graphic">
                        
                            </div>
                          </div>
                        </div>
                  
                      
                  </div>
                  <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="btn-group ms-5" role="group" aria-label="Basic mixed styles example">
                                <button class="btn btn-success" onclick="showGraphicInView(1)">
                                    Top 10 Most Exprensives
                                </button>
                              
                              </div>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group ms-5" role="group" aria-label="Basic mixed styles example">
                                 
                    <button class="btn btn-success p-2" onclick="showGraphicInView(2)">
                        Category Count
                    </button>
                              
                              </div>
                        </div>

                        <div class="col-md-4">
                          <div class="btn-group ms-5" role="group" aria-label="Basic mixed styles example">
                               
                  <button class="btn btn-success p-2" onclick="showGraphicInView(3)">
                      Five Less Stock Products
                  </button>
                            
                            </div>
                      </div>
                    </div>
                  </div>
                 
                </div>
                
                    
                <!-- /.card-body -->
            </div>
            @include('admin.provider.partials.actions')
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</div>





@endsection

@section('scripts')

     <!--inicio librerías básicas para trabajar con los gráficos-->
<script src={{asset("plugins/HighChart/code/highcharts.js")}}></script>
<script src={{asset("plugins/HighChart/code/modules/export-data.js")}}></script>
<script src={{asset("plugins/HighChart/code/modules/exporting.js")}}></script>


<!--fin de las librerías básicas para trabajar con los gráficos-->

<!--drilldown.js es necesario para hacer gráficos más profundos-->
<!--<script src={{asset("plugins/HighChart/code/modules/drill.js")}}></script>-->
<script src={{asset("js/modules/graphics/graphics.js")}}></script>
<script src={{asset("plugins/chart.js/Chart.min.js")}}></script>

@endsection
