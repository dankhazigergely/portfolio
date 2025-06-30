import React, { useState, useEffect } from 'react';
import { useParams, Link } from 'react-router-dom';
import ReactMarkdown from 'react-markdown';

const ProjectDetailPage = () => {
    const { slug } = useParams();
    const [project, setProject] = useState(null);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState(null);

    useEffect(() => {
        const fetchProject = async () => {
            try {
                const response = await fetch(`/api/projects/${slug}`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();
                setProject(data.data); // Assuming data is nested under a 'data' key
            } catch (e) {
                setError(e.message);
            } finally {
                setLoading(false);
            }
        };

        fetchProject();
    }, [slug]);

    if (loading) {
        return <p>Loading project details...</p>;
    }

    if (error) {
        return <p>Error loading project: {error}</p>;
    }

    if (!project) {
        return <p>Project not found.</p>;
    }

    return (
        <div className="project-detail-page">
            <Link to="/projektek">Vissza a projektekhez</Link>
            <h1>{project.title}</h1>
            {project.hero_image && <img src={project.hero_image} alt={project.title} className="hero-image" style={{maxWidth: '600px', width: '100%'}} />}

            <div className="project-content">
                <h2>Leírás</h2>
                <ReactMarkdown>{project.description}</ReactMarkdown>
            </div>

            {project.external_url && (
                <div className="project-link">
                    <a href={project.external_url} target="_blank" rel="noopener noreferrer">
                        Projekt megtekintése
                    </a>
                </div>
            )}

            {project.gallery_images && project.gallery_images.length > 0 && (
                <div className="project-gallery">
                    <h2>Képgaléria</h2>
                    <div className="gallery-grid">
                        {project.gallery_images.map((image, index) => (
                            <img key={index} src={image.url} alt={`${project.title} - gallery image ${index + 1}`} style={{maxWidth: '150px', margin: '5px'}}/>
                        ))}
                    </div>
                </div>
            )}

            {project.downloadable_files && project.downloadable_files.length > 0 && (
                <div className="project-downloads">
                    <h2>Letölthető fájlok</h2>
                    <ul>
                        {project.downloadable_files.map((file, index) => (
                            <li key={index}>
                                <a href={file.url} download={file.name}>
                                    {file.name}
                                </a>
                            </li>
                        ))}
                    </ul>
                </div>
            )}
        </div>
    );
};

export default ProjectDetailPage;
