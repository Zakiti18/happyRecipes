let url = "https://api.nal.usda.gov/fdc/v1/foods/list";
let key = "2oTC5zgxwMUkTLgfkKo254ZfLwXfHzfRVsXmpYok";

// when button is clicked
$("#randomRecipeBtn").on("click", function(){
    // find a random page number
    let randomPageNumber = Math.floor(Math.random() * 200) + 1;

    // define an array of parameters for the call to the API
    let params = {
        "api_key": key,
        "pageNumber": randomPageNumber
    };

    // read from the API
    $.getJSON(url, params, function(result){
        // find a random food on the page
        let randomFood = Math.floor(Math.random() * 50) + 1;
        result = result[randomFood];

        if(typeof result !== "undefined"){
            // set the name of the food
            $("#foodName").html(result.description.trim());

            // set the nutrients of the food
            let nutrientsArray = [];
            $("#foodNutrients").html("<p></p>");
            // store all nutrients in an array
            $.each(result.foodNutrients, function(index, item){
                nutrientsArray.push(item.name + " (" + item.unitName + ")");
            });
            // append all nutrients to html
            console.log(nutrientsArray.length)
            for(let i = 0; i < nutrientsArray.length; i++){
                if (i >= nutrientsArray.length - 1) {
                    $("#foodNutrients").append(nutrientsArray[i] + ".");
                } else {
                    $("#foodNutrients").append(nutrientsArray[i] + " | ");
                }
            }
        }
        else{
            $("#foodName").html("Food not found, please click button again!");
            $("#foodNutrients").html("Food not found, please click button again!");
        }
    }); // end of json
}); // end of on click