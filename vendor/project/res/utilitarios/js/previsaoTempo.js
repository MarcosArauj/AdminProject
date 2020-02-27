
$.ajax({
    type:"GET",
    //url:"http://api.openweathermap.org/data/2.5/weather?q=Recife,br&units=metric&lang=pt",
      url:"http://samples.openweathermap.org/data/2.5/weather?q=London,uk&appid=b6907d289e10d714a6e88b30761fae22",
      async:false
    }).done(function (data) {
        console.log(data.main.temp);
        console.log(data.name);
        console.log(data.weather);
    }).fail(function () {

    });