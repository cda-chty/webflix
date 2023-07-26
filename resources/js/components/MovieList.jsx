import axios from 'axios';
import { useEffect, useState } from 'react';
import Movie from './Movie';

function MovieList() {
    const [movies, setMovies] = useState([]);
    const [loading, setLoading] = useState(false);
    const [search, setSearch] = useState('');
    const searched = () => {
        return movies.filter(movie => {
            return movie.title.toLowerCase().includes(search.toLowerCase());
        });
    }

    useEffect(() => {
        setLoading(true);
        // Requête sur l'API pour aller chercher les films
        axios.get('http://localhost:8000/api/films').then((response) => {
            setTimeout(() => {
                setMovies(response.data);
                setLoading(false);
            }, 1000); // là on récupère les films
        });
    }, [search]);

    if (loading && false) {
        return (
            <div className="text-center my-5">
                <div className="spinner-grow"></div>
            </div>
        );
    }

    return (
        <div>
            <div className="d-flex justify-content-between">
                <h1>Les films</h1>
                <div>
                    <input type="text" className="form-control" value={search}
                        placeholder="Recherche..." onChange={(e) => setSearch(e.target.value)} />
                </div>
            </div>

            <div className="row row-cols-2 row-cols-lg-4">
                {!loading && searched().map(movie => <Movie key={movie.id} movie={movie} />)}
            </div>

            {loading && <div className="text-center my-5">
                <div className="spinner-grow"></div>
            </div>}
        </div>
    );
}

export default MovieList;
