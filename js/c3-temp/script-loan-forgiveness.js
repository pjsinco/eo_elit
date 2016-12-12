
var chart = c3.generate({
    data: {
        columns: [
        ['Total amount paid', 272515, 292291, 405124, 439585, 203039, 137303, 137303, 304640, 445790],
        ['Projected loan forgiveness*', 0, 0, 0, 0, 259652, 322697, 322697, 220360, 69484]  
        ],

        // type: 'bar',
        types: {
            'Total amount paid': 'spline',
            'Projected loan forgiveness*': 'spline'
        },

        colors: {
            'Total amount paid': '#ef3f23',
            'Projected loan forgiveness*' : 'gray',
            // 'First monthly payment': '#a6bbc8',
            // 'Last monthly payment': 'black'
        },
        color:function(color,d){
            return d.id && d.id ==='data3' ? d3.rgb(color).darker(d.value/150) :color;
        }
    },
    // bar: {
    //     width: {
    //         ratio: 0.5 // this makes bar width 50% of length between ticks
    //     }
    //     // or
    //     //width: 100 // this makes bar width 100px
    // },
    axis: {
        x:{
            label: {
                text:'Repayment plan',
                position: 'inner-right'
                    },
            type: 'category',
            tick: {
            	rotate: 75,
            	multiline:false
            },
            categories: [ 'Standard','Graduated','Extended Fixed', 
            'Extended Graduated', 'REPAYE',
            'PAYE', 'IBR for New Borrowers',
            'IBR','ICR']
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

// setTimeout(function () {
//     chart.load({
//         columns: [
//         ['Total amount paid', 272515, 292291, 405124, 439585, 203039, 137303, 137303, 304640, 445790],
//         ['Projected loan forgiveness*', 0, 0, 0, 0, 259652, 322697, 322697, 220360, 69484]  
//             ]
//     });
// }, 5000);




