var chart = c3.generate({
    padding: {
      left: 72,
      right: 10,
    },
    data: {
        columns: [
            ['First monthly payment', 2271, 1306, 1350, 1083, 310, 310, 310, 465, 719],
            ['Last monthly payment', 2271, 3917, 1350, 1966, 1219, 928, 928, 1828, 2611]
        ],

        type: 'bar',
        types: {
            'Total amount paid': 'spline',
            'Projected loan forgiveness*': 'spline'
        },

        colors: {
            'Total amount paid': '#ef3f23',
            'Projected loan forgiveness*' : 'gray',
            'First monthly payment': '#a6bbc8',
            'Last monthly payment': 'black'
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
                position: 'outer-left'
                    },
            type: 'category',
            categories: [ 'Standard','Graduated','Extended Fixed', 
            'Extended Graduated', 'REPAYE',
            'PAYE', 'IBR for New Borrowers',
            'IBR','ICIR']
        },
        y:{
            label:{
                text:'Dollar Amount',
                position: 'outer-middle'
                  },
            tick:{
                format: d3.format("$,")  
                },
            }
        },

        legend: {
            position: 'inset'
        },
});

setTimeout(function () {
    chart.load({
        columns: [
        ['Total amount paid', 272515, 292291, 405124, 439585, 203039, 137303, 137303, 304640, 445790],
        ['Projected loan forgiveness*', 0, 0, 0, 0, 259652, 322697, 322697, 220360, 69484]  
            ]
    });
}, 5000);




