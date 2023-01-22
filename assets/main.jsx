import React from 'react';
import { createRoot } from 'react-dom/client';
import App from "./components/App/App";
import '@epam/uui-components/styles.css';
import '@epam/promo/styles.css';

const container = document.getElementById('app');
const root = createRoot(container);
root.render(<App />);
