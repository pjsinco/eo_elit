
var chart = c3.generate({
    padding: {
      left: 62,
      right: 0,
    },
    bindto: '#chart2', 
    data: {
        columns: [
            ['First monthly payment', 2271, 1306, 1350, 1083, 310, 310, 310, 465, 719],
        ],

        type: 'bar',
        colors: {
            'First monthly payment': '#ef3f23',
            'Last monthly payment': 'gray'
        },
        color:function(color,d){
            return d.id && d.id ==='data3' ? d3.rgb(color).darker(d.value/150) :color;
        }
        
    },
    bar: {
        width: {
            ratio: 0.5 // this makes bar width 50% of length between ticks
        }
        // or
        //width: 100 // this makes bar width 100px
    },
    axis: {
        x:{
            label: {
                text:'Repayment plan',
                position: 'inner-left'
                    },
                    tick:{
            rotate: 75,
            multiline: false
            },
            type: 'category',
            categories: [ 'Standard','Graduated','Extended Fixed', 
            'Extended Graduated', 'REPAYE',
            'PAYE', 'IBR for New Borrowers',
            'IBR','ICR']
        },

        y:{
            label:{
                text:'Dollar amount',
                position: 'outer-middle'
                  },
            tick:{
                format: d3.format("$,")  
                }
           } 
        },

        legend:{
            position: 'inset',
        },

 
            

});

setTimeout(function () {
    chart.load({
        columns: [
        ['Last monthly payment', 2271, 3917, 1350, 1966, 1219, 928,928,1828, 2611]  
            ]
    });
}, 2000);
