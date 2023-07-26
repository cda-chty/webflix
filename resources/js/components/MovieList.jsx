import axios from 'axios';
import { useEffect, useState } from 'react';

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
            <p>Intégrer les films sur 4 colonnes (avec une carte) avec titre, photo, category, durée</p>
            <p>L'intégration devra se faire dans un composant qui aura pour props le movie</p>
            {movies.map(movie =>
                <div>{movie.title}</div>
            )}
        </div>
    );
}

export default MovieList;
