import axios from 'axios';
import { useEffect, useState } from 'react';
import Movie from './Movie';

function MovieList() {
    const [movies, setMovies] = useState([]);
    const [loading, setLoading] = useState(false);

    useEffect(() => {
        setLoading(true);
        // Requête sur l'API pour aller chercher les films
        axios.get('http://localhost:8000/api/films').then((response) => {
            setTimeout(() => {
                setMovies(response.data);
                setLoading(false);
            }, 1000); // là on récupère les films
        });
    }, []);

    if (loading) {
        return (
            <div className="text-center my-5">
                <div className="spinner-grow"></div>
            </div>
        );
    }

    return (
        <div>
            <h1>Les films</h1>

            <div className="row row-cols-2 row-cols-lg-4">
                {movies.map(movie => <Movie key={movie.id} movie={movie} />)}
            </div>
        </div>
    );
}

export default MovieList;
