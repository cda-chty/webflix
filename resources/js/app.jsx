import './bootstrap';
import ReactDOM from 'react-dom/client';
import MovieList from './components/MovieList';

const root = document.getElementById('root');

// On lance React que sur les pages avec React
if (root) {
    ReactDOM.createRoot(root).render(<MovieList />);
}
