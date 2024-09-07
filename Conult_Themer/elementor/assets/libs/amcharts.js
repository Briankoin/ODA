am5.ready(function() {


    var root = am5.Root.new("chartdiv");


    root.setThemes([
        am5themes_Animated.new(root)
    ]);

    // Create the map chart
    // https://www.amcharts.com/docs/v5/charts/map-chart/
    var chart = root.container.children.push(
        am5map.MapChart.new(root, {
            panX: "none",
            panY: "none",
            wheelX: "none",
            wheelY: "none",
            projection: am5map.geoMercator(),
        })
    );

    var zoomControl = chart.set("zoomControl", am5map.ZoomControl.new(root, {}));
    zoomControl.homeButton.set("visible", true);


    // Create main polygon series for countries
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-polygon-series/
    var polygonSeries = chart.series.push(
        am5map.MapPolygonSeries.new(root, {
            geoJSON: am5geodata_worldLow,
            exclude: ["AQ"]
        })
    );

    polygonSeries.mapPolygons.template.setAll({
        fill: am5.color(0xFDB813),
        stroke: am5.color(0xffff00),
    });


    // Initialization of the markers
    // https://www.amcharts.com/docs/v5/charts/map-chart/map-point-series/
    var pointSeries = chart.series.push(am5map.ClusteredPointSeries.new(root, {}));


    // Set clustered bullet
    // https://www.amcharts.com/docs/v5/charts/map-chart/clustered-point-series/#Group_bullet
    pointSeries.set("clusteredBullet", function(root) {
        var container = am5.Container.new(root, {
            cursorOverStyle: "pointer"
        });

        var label = container.children.push(am5.Label.new(root, {
            centerX: am5.p50,
            centerY: am5.p50,
            fill: am5.color(0x000000),
            populateText: true,
            fontSize: "8",
            text: "{value}"
        }));



        container.events.on("click", function(e) {
            pointSeries.zoomToCluster(e.target.dataItem);
        });

        return am5.Bullet.new(root, {
            sprite: container
        });
    });

    // Country bullets styling
    pointSeries.bullets.push(function() {
        var circle = am5.Circle.new(root, {
            radius: 5,
            tooltipY: 0,
            fill: am5.color(0x000000),
            tooltipText: "{title}"
        });



        return am5.Bullet.new(root, {
            sprite: circle
        });
    });


    // Data for countries
    var cities = [

        {
            title: "Nairobi",
            latitude: -1.2762,
            longitude: 36.7965
        },
        {
            title: "Cairo",
            latitude: 30.0444,
            longitude: 31.2357
        },
        {
            title: "Quito",
            latitude: -0.1767,
            longitude: -78.4810
        },
        {
            title: "Juneau",
            latitude: 58.3005,
            longitude: -134.4201
        },
        {
            title: "Nuuk",
            latitude: 64.1743,
            longitude: -51.7373
        },
        {
            title: "Algiers",
            latitude: 36.7538,
            longitude: 3.0588
        },
        {
            title: "Kinshasa",
            latitude: -4.322447,
            longitude: 15.307045
        },
        {
            title: "Cape Town",
            latitude: -33.9221,
            longitude: 18.4231
        },
        {
            title: "Moscow",
            latitude: 55.7558,
            longitude: 37.6173
        },
        {
            title: "Kabul",
            latitude: 34.5553,
            longitude: 69.2075
        },
        {
            title: "Zhilinda",
            latitude: 70.1333,
            longitude: 113.9833
        },
        {
            title: "Chokurdakh",
            latitude: 70.6222,
            longitude: 147.9162
        }

    ];

    for (var i = 0; i < cities.length; i++) {
        var city = cities[i];
        addCity(city.longitude, city.latitude, city.title);
    }

    function addCity(longitude, latitude, title) {
        pointSeries.data.push({
            geometry: {
                type: "Point",
                coordinates: [longitude, latitude]
            },
            title: title
        });
    }

    // Make stuff animate on load
    chart.appear(1000, 100);

});