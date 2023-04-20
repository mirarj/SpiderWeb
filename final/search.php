<!DOCTYPE html>

<html>

    <head>
	    <meta charset="utf-8"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MyMovieNetwork</title>
        <link rel="stylesheet" href="style.css">
    </head>

    

<style>

    * {
        font-family: Arial, Helvetica, sans-serif;
    }
    h1 {
        text-align: center;
        color: black;
    }
    #todays_astronomy {
        background-color: rgba(38, 38, 198, 0.4);
        width: 70%;
        margin-right: auto;
        margin-left: auto;
        border-radius: 10px;

    }

    #date, #title, #description {
        margin-right: auto;
        margin-left: auto;
        display: block;
        text-align: center;
    }


    img {
        width: 70%;
        margin-right: auto;
        margin-left: auto;
        display: block;
        margin-top: 40px;
        margin-bottom: 40px;
    }

    #date {
        padding-top: 15px;
        font-size: 18px;
    }

    #description {
        font-size: 20px;
        padding-bottom: 40px;
        width: 90%;
    }
</style>
</head>


<body>

<div id="search">

</div>
    


<div id="show_data">
    <p id="title"></p>
    <p id="release"></p>
    <p id="description"></p>
    <p id="genres"></p>
    
</div>

<?php
$url = 'https://api.themoviedb.org/3/genre/movie/list?api_key=fcabeffb7c941589973c5ba5beb7f636&language=en-US';
$collection_name = 'genres';
$request_url = $url . '/' . $collection_name;
$curl = curl_init($request_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
  'X-genres-Host: api.themoviedb.org/3/genre/movie/list?api_key=',
  'X-genres-Key: fcabeffb7c941589973c5ba5beb7f636',
  'Content-Type: application/json'
]);
$response = curl_exec($curl);
$decoded_json = json_decode($response, true);
$genres = $decoded_json['genres'];
$genre_name_id = array();
foreach($genres as $genre) {
    $genre_name_id[$genre['name']] = $genre['id'];
}


curl_close($curl);

?>

<script>
        function get_cast_info(movie_id, i) {
            let URL = "https://api.themoviedb.org/3/movie/"+movie_id+"/credits?api_key=fcabeffb7c941589973c5ba5beb7f636&language=en-US";
                res = fetch(URL)
                    .then (res => res.text())
                    .then (data => 
                    {
                        var people = JSON.parse(data);
                        var cast_length = Object.keys(people["cast"]).length;
                        console.log("people lenght: " + cast_length);
                        document.getElementById("movie" + i).innerHTML += "<ul id='cast'>"
                        if (cast_length == 0) {
                            document.getElementById("movie" + i).innerHTML += "<li id='cast0'> No cast information found at this time. </li>";
                        }
                        else {
                            for (let k = 0; k < cast_length; k++) {
                                if (people["cast"][k].known_for_department == "Acting") {
                                    document.getElementById("movie" + i).innerHTML += "<li id='cast" + k + "'> " + people["cast"][k].name + "</li>";
                                }
                            }
                        }
                    })
                    .catch (error => console.log(error))

        }

        function buildSearch() {
            let URL = "https://api.themoviedb.org/3/genre/movie/list?api_key=fcabeffb7c941589973c5ba5beb7f636&language=en-US";
            let t = "<input name='query' id='query' type='text' placeholder='Enter search query here'><input name='year' id='year' type='text' placeholder='Enter year of release here'><input name='cast' id='cast' type='text' placeholder='Enter actor name here'>";
				res = fetch(URL)
                    .then (res => res.text())
                    .then (data => 
                    {

						t += "<select name='genre_select' size='1'>";
                        genres = JSON.parse(data)
						//document.getElementById("search").innerHTML += "<select name='genre_select' size='1'>";
                        t += "<option> No Selection </option>";
						for (let i = 0; i < genres.genres.length; i++) {
                            t += "<option>" + genres.genres[i].name + "</option>";
                        }
						t += "</select>";
						t += "<br /><button onclick='getAPI()'>Submit</button>"
						document.getElementById("search").innerHTML += t;
                    })
                    .catch (error => console.log(error))
                    
        }

        function output(movie_id, i, title, img_source, genre_array_php, genres, overview, date, cast_search) {
            document.getElementById("show_data").innerHTML += "<div id='movie" + i + "' style='border: 1px solid black'>"
            document.getElementById("movie" + i).innerHTML += "<img id='poster' src='"+"http://image.tmdb.org/t/p/w500/" + img_source + "' style = 'width: 200px'>";
            document.getElementById("movie" + i).innerHTML += "<p id='title'> " + title + "</p>";
            document.getElementById("movie" + i).innerHTML += "<p id='genres'> ";
            for (var key in genre_array_php) {
                genres.forEach(element => {
                    if (genre_array_php[key] == element)
                        document.getElementById("movie" + i).innerHTML += key + ", "
                });
            }
            get_cast_info(movie_id, i);
            document.getElementById("movie" + i).innerHTML += "</ul>"
            document.getElementById("movie" + i).innerHTML += "</p>";
            document.getElementById("movie" + i).innerHTML += "<p id='overview'> " + overview + "</p>";
            document.getElementById("movie" + i).innerHTML += "<p id='date'> " + date + "</p>";
            document.getElementById("movie" + i).innerHTML += "<button id='add_to_wishlist'> Add to wishlist </button>";
            document.getElementById("movie" + i).innerHTML += "<button id='add_to_watched'> Add to watched </button>";
            document.getElementById("show_data").innerHTML += "</div>"
        }
        function getAPI() {

            document.getElementById("show_data").innerHTML = "";
            let query = $("#query").val();

            if (query == "") {
                alert("Query is required!")
            }

            else {
                let year = $("#year").val();
                let genre = $('select[name="genre_select"]').val();
                let cast_search = $('#cast').val();
                console.log("query is: " + query);
                console.log("year is: " + year);

                let URL = "https://api.themoviedb.org/3/search/movie?api_key=fcabeffb7c941589973c5ba5beb7f636&query=" + query;

                if (year != "") {
                    URL += "&year=" + year;
                }

                URL += "&adult=false";

                /* Step 1: Make instance of request object...
                ...to make HTTP request after page is loaded*/
                res = fetch(URL)
                    .then (res => res.text())
                    .then (data => 
                    {
                        console.log(data);
                        console.log(data.lenght);
                        movies = JSON.parse(data)
                        //console.log(Object.keys(movies).lenght);
                        console.log(movies);
                        console.log(movies["results"]);
                        console.log("num: " + movies["total_results"]);
                        console.log("movies[results][0]: " + movies["results"][0]);
                        var genre_array_php = <?= json_encode($genre_name_id) ?>;
                        

                        if (movies["total_results"] == 0) {
                            // add something
                        }
                       
                        if (genre == "No Selection") {
                            for (let i = 0; i < movies["total_results"]; i++) {
                                let obj = movies["results"][i];
                                let title = obj.title;
                                let genres = obj["genre_ids"];
                                let img_source = obj["poster_path"];
                                let overview = obj["overview"];
                                let date = obj["release_date"];
                                let movie_id = obj["id"];
                            
                                output(movie_id, i, title, img_source, genre_array_php, genres, overview, date,cast_search);
                            }
                        }
                        
                        else {
                            console.log("movies[\"results\"][2][\"genre_ids\"].lenght: " + movies["results"][2]["genre_ids"]);
                            console.log("watch out");
                            for (let k = 0; k < movies["total_results"]; k++) {
                                let obj = movies["results"][k];
                                obj["genre_ids"].forEach(element => {
                                    if (element == genre_array_php[genre]) {
                                        console.log("in here");
                                        let title = obj.title;
                                        let genres = obj["genre_ids"];
                                        let img_source = obj["poster_path"];
                                        let overview = obj["overview"];
                                        let date = obj["release_date"];
                                        let movie_id = obj["id"];

                                        output(movie_id, k, title, img_source, genre_array_php, genres, overview, date, cast_search);                                    }
                                });
                            }
                        }
                        
                    })
                    .catch (error => console.log(error))

                        
            }
        }

        function getGenreArray() {
            const name = [];
            const id = [];
            request = new XMLHttpRequest();
            console.log("1 - request object created");

            request.open("GET", "https://api.themoviedb.org/3/genre/movie/list?api_key=fcabeffb7c941589973c5ba5beb7f636&language=en-US", true)

            console.log("2 - opened request file");

            // Step 3: set up event handler/callback

            request.onreadystatechange = function() {
            console.log("3 - readystatechange event fired.");

            if (request.readyState == 4 && request.status == 200) {
                // Step 5: wait for done + success
                console.log("5 - response received");
                result = request.responseText;
                genres = JSON.parse(result);
                for (let i = 0; i < genres.genres.length; i++) {
                    name.push(genres.genres[i].name);
                    id.push(genres.genres[i].id);
                }
                console.log("name: " + name);
                console.log("id: " + id);
            }
            else if (request.readyState == 4 && request.status != 200) {
                console.log("Something is wrong!  Check the logs to see where this went off the rails");
            }

            else if (request.readyState == 3) {
                console.log("Too soon!  Try again");
            }

            console.log("name1: " + name);
            console.log("id1: " + id);
            return name;

            }
        // Step 4: fire off the HTTP request
            request.send();
            console.log("4 - Request sent");
        }
        
        buildSearch();
        get_cast_info(99861);
</script>



</body>

</html>
