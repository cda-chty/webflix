import { useState } from 'react';

function Movie({ movie }) {
    const [showSynosis, setShowSynosis] = useState(false);

    return (
        <div className="col mb-4">
            <div className="card shadow-sm">
                {!showSynosis && <img className="card-img-top" src={movie.cover} alt={movie.title} />}
                <div className="card-body text-center">
                    <h5 className="card-title">{movie.title}</h5>
                    {showSynosis && <p className="card-text">{movie.synopsis}</p>}
                    <p className="card-text">
                        {movie.duration}
                        {movie.category && <span> | {movie.category.name}</span>}
                    </p>
                    <button onClick={() => setShowSynosis(!showSynosis)} className="btn btn-primary">
                        {showSynosis ? 'Voir' : 'Lire'}
                    </button>
                </div>
            </div>
        </div>
    );
}

export default Movie;
