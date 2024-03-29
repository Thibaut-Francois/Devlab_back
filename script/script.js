// https://api.themoviedb.org/3/movie/200%7B1%7D?api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=fr-FR
// /movie/id

// https://api.themoviedb.org/3/discover/movie?primary_release_year=2010&sort_by=vote_average&api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=fr-FR

// https://api.themoviedb.org/3/discover/movie?release_date.desc&api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=fr-FR

// https://api.themoviedb.org/3/discover/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&with_genres=10749&language=fr-FR

// &include_adult=true


fetch('https://api.themoviedb.org/3/discover/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&with_genres=16&language=fr-FR')
            .then(response => response.json())
            .then(data =>{
                //console.log(data['results'])

                
                const inHtml = document.querySelector("#card")

                data.results.forEach(movie => {
                    //console.log(movie)

                    const films = document.createElement("section")
                    films.innerHTML = "<p>"+movie.title+"</p>"
                    films.setAttribute('token', movie.id)
                    films.setAttribute("class", "unClick")
                    inHtml.appendChild(films)



                    const image = document.createElement("img")
                    if(movie.poster_path == null){
                        image.setAttribute("src", "https://bougezvousavecnous.fr/wp-content/uploads/2020/10/no-image.jpg")
                    }else{
                        image.setAttribute("src", "https://image.tmdb.org/t/p/w500"+movie.poster_path)
                    }
                    image.setAttribute("class", "mov_img")
                    films.appendChild(image)
                
                
                })

                document.querySelectorAll('.unClick').forEach(el => {
                    el.addEventListener('click', event => {
                        //console.log(el.getAttribute('token'))
                        window.location.replace("single.php?id="+el.getAttribute('token'));
                    })
                })

            })



btn = document.querySelector("#decouverte")
btn.addEventListener("click", decouverte)

btn = document.querySelector("#tendance")
btn.addEventListener("click", tendance)

btn = document.querySelector("#albumsPubliques")
btn.addEventListener("click", albumsPubliques)


function decouverte(){
    document.querySelector("#discover").style.display = "flex"

    document.querySelector("#card").style.display ="none"
    document.querySelector("#tendances").style.display ="none"
    document.querySelector("#publiqueAlbum").style.display ="none"
    document.querySelector("#result").style.display = "none"

    fetch('https://api.themoviedb.org/3/discover/movie?release_date.desc&api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=fr-FR')
    .then(response => response.json())
    .then(data =>{

        const dansHtml2 = document.querySelector("#discover")

        dansHtml2.innerHTML = ""


        //console.log(data)

        data.results.forEach(movie => {
            //console.log(movie)

            const films = document.createElement("section")
            films.innerHTML = "<p>"+movie.title+"</p>"
            films.setAttribute('token', movie.id)
            films.setAttribute("class", "unClick")
            dansHtml2.appendChild(films)


            const image = document.createElement("img")
            if(movie.poster_path == null){
                image.setAttribute("src", "https://bougezvousavecnous.fr/wp-content/uploads/2020/10/no-image.jpg")
            }else{
                image.setAttribute("src", "https://image.tmdb.org/t/p/w500"+movie.poster_path)
            }
            image.setAttribute("class", "mov_img")
            films.appendChild(image)
        
        })

        document.querySelectorAll('.unClick').forEach(el => {
            el.addEventListener('click', event => {
                //console.log(el.getAttribute('token'))
                window.location.replace("single.php?id="+el.getAttribute('token'));
            })
        })
    })
}


function tendance(){
    document.querySelector("#tendances").style.display = "flex"

    document.querySelector("#card").style.display ="none"
    document.querySelector("#discover").style.display ="none"
    document.querySelector("#publiqueAlbum").style.display ="none"
    document.querySelector("#result").style.display = "none"

    fetch('https://api.themoviedb.org/3/trending/movie/week?release_date.desc&api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=fr-FR')
    .then(response => response.json())
    .then(data =>{

        const dansHtml2 = document.querySelector("#tendances")

        dansHtml2.innerHTML = ""

        //console.log(data)

        data.results.forEach(movie => {
            //console.log(movie)

            const films = document.createElement("section")
            films.innerHTML = "<p>"+movie.title+"</p>"
            films.setAttribute('token', movie.id)
            films.setAttribute("class", "unClick")
            dansHtml2.appendChild(films)


            const image = document.createElement("img")
            if(movie.poster_path == null){
                image.setAttribute("src", "https://bougezvousavecnous.fr/wp-content/uploads/2020/10/no-image.jpg")
            }else{
                image.setAttribute("src", "https://image.tmdb.org/t/p/w500"+movie.poster_path)
            }
            image.setAttribute("class", "mov_img")
            films.appendChild(image)
        
        })

        document.querySelectorAll('.unClick').forEach(el => {
            el.addEventListener('click', event => {
                //console.log(el.getAttribute('token'))
                window.location.replace("single.php?id="+el.getAttribute('token'));
            })
        })
    })
}

function albumsPubliques(){
    document.querySelector("#publiqueAlbum").style.display = "flex"

    document.querySelector("#card").style.display ="none"
    document.querySelector("#discover").style.display ="none"
    document.querySelector("#tendances").style.display ="none"
    document.querySelector("#result").style.display = "none"
}

function results(key){
    document.querySelector("#result").style.display = "flex"

    document.querySelector("#publiqueAlbum").style.display = "none"
    document.querySelector("#card").style.display ="none"
    document.querySelector("#discover").style.display ="none"
    document.querySelector("#tendances").style.display ="none"



    fetch('https://api.themoviedb.org/3/search/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=fr-FR&query='+key)
        .then(response => response.json())
        .then(data =>{

            const dansHtml2 = document.querySelector("#result")
            dansHtml2.innerHTML = ""
            //console.log(data)

            if (data.success===false || data.results.length ===0){
                //console.log("MORT")

                const films = document.createElement("section")
                films.innerHTML = "<p>Aucun résultat n'a été trouvé</p>"
                dansHtml2.appendChild(films)

            }else{
                //console.log("OK")

                data.results.forEach(movie => {
                    //console.log(movie)

                    const films = document.createElement("section")
                    films.innerHTML = "<p>"+movie.title+"</p>"
                    films.setAttribute('token', movie.id)
                    films.setAttribute("class", "unClick")
                    dansHtml2.appendChild(films)


                    const image = document.createElement("img")
                    if(movie.poster_path == null){
                        image.setAttribute("src", "https://bougezvousavecnous.fr/wp-content/uploads/2020/10/no-image.jpg")
                    }else{
                        image.setAttribute("src", "https://image.tmdb.org/t/p/w500"+movie.poster_path)
                    }
                    image.setAttribute("class", "mov_img")
                    films.appendChild(image)

                })
                document.querySelectorAll('.unClick').forEach(el => {
                    el.addEventListener('click', event => {
                        //console.log(el.getAttribute('token'))
                        window.location.replace("single.php?id="+el.getAttribute('token'));
                    })
                })
            }


        })
}
