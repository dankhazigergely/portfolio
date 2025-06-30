import { render, screen } from '@testing-library/react';
import { describe, it, expect, vi, beforeEach } from 'vitest';
import createFetchMock from 'vitest-fetch-mock';
import App from './App';

const fetchMocker = createFetchMock(vi);

describe('App', () => {
  beforeEach(() => {
    fetchMocker.enableMocks();
    // Mock the environment variable, ensure it's available for all tests in describe
    const originalEnv = import.meta.env;
    import.meta.env = { ...originalEnv, VITE_API_BASE_URL: 'http://localhost:8000' }; // Use a typical local dev URL
  });

  it('renders the ProjectListPage and shows loading state, then mock data', async () => {
    // Mock a successful API response for /api/projects
    fetchMocker.mockResponseOnce(JSON.stringify({
      data: [{ id: 1, slug: 'test-project', title: 'Test Project', short_description: 'A test project' }]
    }));

    render(<App />);
    
    // Check for the loading state from ProjectListPage
    expect(screen.getByText(/Loading projects.../i)).toBeInTheDocument();

    // Wait for the project title to appear after mock fetch completes
    // We expect the title to be within an h3 tag
    const projectTitle = await screen.findByRole('heading', { name: /Test Project/i, level: 3 });
    expect(projectTitle).toBeInTheDocument();

    // Check if the short description is also there, more specifically
    expect(screen.getByText((content, element) => {
      return element.tagName.toLowerCase() === 'p' && content.startsWith('A test project');
    })).toBeInTheDocument();

    // You can also check that fetch was called correctly
    expect(fetchMocker).toHaveBeenCalledWith('/api/projects');
  });

  it('renders error message if API call fails', async () => {
    // Mock a failed API response
    fetchMocker.mockRejectOnce(new Error('API Error'));

    render(<App />);

    // Check for the loading state first
    expect(screen.getByText(/Loading projects.../i)).toBeInTheDocument();

    // Wait for the error message to appear
    const errorMessage = await screen.findByText(/Error loading projects: API Error/i);
    expect(errorMessage).toBeInTheDocument();
  });
});
