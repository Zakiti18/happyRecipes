let url = "https://api.nal.usda.gov/fdc/v1/foods/list";
let key = "2oTC5zgxwMUkTLgfkKo254ZfLwXfHzfRVsXmpYok";

// when button is clicked
$("#randomRecipeBtn").on("click", function(){
    // find a random page number
    let randomPageNumber = Math.floor(Math.random() * 200) + 1;

    // define an array of parameters for the call to the API
    let params = {
        "api_key": key,
        "pageNumber": randomPageNumber,
    };

    // read from the API
    $.getJSON(url, params, function(result){
        // find a random food on the page
        let randomFood = Math.floor(Math.random() * 50) + 1;
        result = result.foods[randomFood];

        // set the name of the food
        $("#foodName").html(result.description);
    }); // end of json
}); // end of on click