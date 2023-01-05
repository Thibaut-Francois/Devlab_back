// https://api.themoviedb.org/3/movie/200%7B1%7D?api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=en-US
// /movie/id

function detaille(id){
    let lien = 'https://api.themoviedb.org/3/movie/'+id+'?api_key=db5946f8d90a2a4716c7c2c3520a77b3'
    console.log(lien)
    fetch(lien)
        .then(response => response.json())
        .then(data => {
            console.log(data)


            const inHtml = document.querySelector("#card")


            const films = document.createElement("section")
            films.innerHTML = "<p>" + data['original_title'] + "</p>" + "<p>" + data['overview'] + "</p>" + "<p>" + data['release_date'] + "</p>"
            //films.setAttribute('token', movie.id)
            // films.setAttribute("class", "unClick")
            inHtml.appendChild(films)


            const image = document.createElement("img")
            if (data['poster_path'] == null) {
                image.setAttribute("src", "https://bougezvousavecnous.fr/wp-content/uploads/2020/10/no-image.jpg")
            } else {
                image.setAttribute("src", "https://image.tmdb.org/t/p/w500" + data["poster_path"])
            }
            films.appendChild(image)


        })
}

