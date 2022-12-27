// https://api.themoviedb.org/3/movie/200%7B1%7D?api_key=db5946f8d90a2a4716c7c2c3520a77b3&language=en-US
// /movie/id

// https://api.themoviedb.org/3/discover/movie?primary_release_year=2010&sort_by=vote_average&api_key=db5946f8d90a2a4716c7c2c3520a77b3

// https://api.themoviedb.org/3/discover/movie?release_date.desc&api_key=db5946f8d90a2a4716c7c2c3520a77b3

// https://api.themoviedb.org/3/discover/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&with_genres=10749

// &include_adult=true


fetch('https://api.themoviedb.org/3/discover/movie?api_key=db5946f8d90a2a4716c7c2c3520a77b3&with_genres=10749')
    .then(response => response.json())
    .then(data =>{
        //console.log(data['results'])


        const inHtml = document.querySelector("#card")

        data.results.forEach(movie => {
            //console.log(movie)

            const films = document.createElement("section")
            films.innerHTML = "<p>"+movie.title+"</p>"
            films.setAttribute('token', movie.id)
            //console.log(films.id)
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

        // document.querySelectorAll('.unClick').forEach(el => {
        //     el.addEventListener('click', event => {
        //         //console.log(el.getAttribute('token'))
        //         enDetails(el.getAttribute('token'))
        //         })
        //     })

    })

// function find(){
//     let input = document.getElementById('searchbar').value
//     input=input.toLowerCase();


btn = document.querySelector("#decouverte")
btn.addEventListener("click", decouverte)

btn = document.querySelector("#tendance")
btn.addEventListener("click", tendance)

function decouverte(){
    const dansHtml = document.querySelector("#discover")

    dansHtml.style.display = "flex"
    document.querySelector("#card").style.display ="none"
    document.querySelector("#tendances").style.display ="none"

    fetch('https://api.themoviedb.org/3/discover/movie?release_date.desc&api_key=db5946f8d90a2a4716c7c2c3520a77b3')
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
                //console.log(films.id)
                // films.setAttribute("class", "unClick")
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
        })
}


function tendance(){
    const dansHtml = document.querySelector("#tendances")

    dansHtml.style.display = "flex"
    document.querySelector("#card").style.display ="none"
    document.querySelector("#discover").style.display ="none"

    fetch('https://api.themoviedb.org/3/trending/movie/week?release_date.desc&api_key=db5946f8d90a2a4716c7c2c3520a77b3')
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
                //console.log(films.id)
                // films.setAttribute("class", "unClick")
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
        })
}
