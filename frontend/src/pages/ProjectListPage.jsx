import React, { useState, useEffect } from 'react';
// Link was unused as ProjectCard handles navigation
import ProjectCard from '../components/ProjectCard';

const ProjectListPage = () => {
    const [projects, setProjects] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchProjects = async () => {
            try {
                const response = await fetch('/api/projects');
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                setProjects(data.data); // Assuming data is nested under a 'data' key
            } catch (e) {
                setError(e.message);
            } finally {
                setLoading(false);
            }
        };

        fetchProjects();
    }, []);

    if (loading) {
        return <p>Loading projects...</p>;
    }

    if (error) {
        return <p>Error loading projects: {error}</p>;
    }

    if (projects.length === 0) {
        return <p>No projects found.</p>;
    }

    return (
        <div className="project-list-page">
            <h1>Projektek</h1>
            <div className="projects-grid">
                {projects.map(project => (
                    <ProjectCard key={project.id} project={project} />
                ))}
            </div>
        </div>
    );
};

export default ProjectListPage;
