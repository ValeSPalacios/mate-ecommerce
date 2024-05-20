window.addEventListener('load',()=>{
    showGraphicInView(1);
})



function showGraphicInView(value) {
    const urls={
        1:'/admin/fiveProductsMostExpensive',
        2:'/admin/categoryCount',
        3:'/admin/fiveLessStock'
    }
    const titles={
        1:'Top 5 Productos Más Caros A La Venta',
        2:'Número Total De Productos Por Categoría',
        3:'5 Productos Con Menos Stock'
    }

    const xLegends={
        1:'Productos',
        2:'Categorias',
        3:'Productos'
    }

    const yLegends={
        1:'Precios',
        2:'Cantidad Productos',
        3:'Stock'
    }
    $.ajax({
        type: "GET",
        dataType: "json",
        url: urls[value],
        data: {
            'email': 1,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status === 200) {
                
                
               
                showGraphic(data,titles[value],xLegends[value],yLegends[value]);
            } else {
                alert('Username already exists');
                $('#email').val('');
            }
        }
    });
}

function showGraphic(data,titulo,leyendaX,leyendaY){
  
    Highcharts.chart('graphic',{
        //charts es el tipo de gráfico que se mostrará
        chart:{
            type:'column'
        },
        //title será el título del gráfico
        title:{
            text:titulo
        },
        //xAxis hace referencia al eje x
        //title es el título que se mostrará en el eje
        xAxis:{
           text:leyendaX,
            //el tipo de datos que se mostrará, en este caso, categóricos
            
            categories:data.labels
        },
        yAxis:{
            //El título del eje y en el gráfico
            title:{
                text:leyendaY
            }
        },
        plotOptions:{
            column:{
                dataLabels: {
                    enabled: true,
                    size:30
                 }
            }
           
        },
        //series es una serie de valores y data son los datos que se mostrarán 
        //en el eje y.
        series:[{
          type:'column',
            colorByPoint:true, 
            data:data.data
        }],
    })
}