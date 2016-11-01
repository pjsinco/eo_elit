
var chart = c3.generate({
    padding: {
      left: 40,
      right: 10,
    },
    data: {
         x: 'x',
        columns: [
            ['x', 
            '1997-01-01', 
            '1998-01-01',
            '1999-01-01',
            '2000-01-01', 
            '2001-01-01',
            '2002-01-01',
            '2003-01-01',
            '2004-01-01',
            '2005-01-01',
            '2006-01-01',
            '2007-01-01',
            '2008-01-01',
            '2009-01-01',
            '2010-01-01',
            '2011-01-01',
            '2012-01-01',
            '2013-01-01',
            '2014-01-01',
            '2015-01-01',
            ],
            
            ['Percentage of obese adults, U.S.', 
            .1950,
            .206, 
            .215, 
            .218, 
            .229, 
            .238,
            .235,
            .243,
            .253,
            .262,
            .266,
            .275,
            .279,
            .283,
            .287,
            .287,
            .289,
            .298,
            .304,
            ]
        ],

        type: 'line',
        colors: {
            'Percentage of obese adults, U.S.': '#ef3f23',
    }
},
    axis : {
        x : {
            type : 'timeseries',
            tick: {
                format: function (x) { return x.getFullYear(); },
              //format: '%Y' // format string is also available for timeseries data
            }
        },
        y : {
            label: {
            text:'Percent',
            position: 'outer-middle'
        },
            tick:{
              format: d3.format(".1%")  
            }
        } 
    },

    legend: {
        position: 'inset'
    },
    zoom: {
        enabled:true
    },   

});

setTimeout(function(){
        chart.transform('bar', 'Percentage of obese adults, U.S.');
    }, 2000);
setTimeout(function () {
    chart.transform('line');
}, 4000);


