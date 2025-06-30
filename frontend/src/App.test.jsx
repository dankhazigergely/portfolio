import { render, screen } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import App from './App';

describe('App', () => {
  it('renders the HelloWorld component which shows loading state', () => {
    // Mock the environment variable
    const originalEnv = import.meta.env;
    import.meta.env = { ...originalEnv, VITE_API_BASE_URL: 'http://test.api' };

    render(<App />);
    
    // The HelloWorld component initially displays "Loading..."
    expect(screen.getByText(/Loading.../i)).toBeInTheDocument();

    // Restore original env
    import.meta.env = originalEnv;
  });
});
