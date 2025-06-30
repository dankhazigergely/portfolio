import './App.css';
import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import ProjectListPage from './pages/ProjectListPage';
import ProjectDetailPage from './pages/ProjectDetailPage';
import HelloWorld from './components/HelloWorld'; // Keep for default route example

function App() {
  return (
    <Router>
      <Routes>
        <Route path="/" element={<Navigate to="/projektek" />} />
        <Route path="/projektek" element={<ProjectListPage />} />
        <Route path="/projektek/:slug" element={<ProjectDetailPage />} />
        <Route path="/hello" element={<HelloWorld />} /> {/* Optional: if you want to keep HelloWorld accessible */}
      </Routes>
    </Router>
  );
}

export default App;
