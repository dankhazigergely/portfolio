import React from 'react';
import { Link } from 'react-router-dom';

const ProjectCard = ({ project }) => {
    if (!project) {
        return null;
    }

    // Ensure all expected properties exist
    const { slug, title, thumbnail, short_description } = project;

    return (
        <div className="project-card">
            <Link to={`/projektek/${slug}`}>
                {thumbnail && (
                    <img
                        src={thumbnail}
                        alt={title || 'Project thumbnail'}
                        className="project-card-thumbnail"
                        style={{ maxWidth: '100%', height: 'auto' }}
                    />
                )}
                <h3 className="project-card-title">{title || 'Untitled Project'}</h3>
                {short_description && <p className="project-card-description">{short_description}</p>}
            </Link>
        </div>
    );
};

export default ProjectCard;
