import './bootstrap';
import Alpine from 'alpinejs';

import React from 'react';
import { createRoot } from 'react-dom/client';
import Home from './Pages/Home';
import Dashboard from './Pages/Dashboard';
import ProfileSettings from './Pages/ProfileSettings';

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    const homeRoot = document.getElementById('react-home');
    if (homeRoot) {
        createRoot(homeRoot).render(<Home />);
    }

    const dashboardRoot = document.getElementById('react-dashboard');
    if (dashboardRoot) {
        const user = JSON.parse(dashboardRoot.dataset.user || '{}');
        const healthData = JSON.parse(dashboardRoot.dataset.health || '{}');
        createRoot(dashboardRoot).render(<Dashboard user={user} healthData={healthData} />);
    }

    const doctorRoot = document.getElementById('react-doctor-dashboard');
    if (doctorRoot) {
        const user = JSON.parse(doctorRoot.dataset.user || '{}');
        const patients = JSON.parse(doctorRoot.dataset.patients || '[]');
        const reports = JSON.parse(doctorRoot.dataset.reports || '[]');
        import('./Pages/DoctorDashboard').then(module => {
            const DoctorDashboard = module.default;
            createRoot(doctorRoot).render(<DoctorDashboard user={user} patients={patients} reports={reports} />);
        });
    }

    const teleRoot = document.getElementById('react-telemedicine-room');
    if (teleRoot) {
        const user = JSON.parse(teleRoot.dataset.user || '{}');
        const peerId = teleRoot.dataset.peerId || '';
        import('./Pages/TelemedicineRoom').then(module => {
            const TelemedicineRoom = module.default;
            createRoot(teleRoot).render(<TelemedicineRoom user={user} peerId={peerId} />);
        });
    }

    const profileSettingsRoot = document.getElementById('react-profile-settings');
    if (profileSettingsRoot) {
        const user = JSON.parse(profileSettingsRoot.dataset.user || '{}');
        createRoot(profileSettingsRoot).render(<ProfileSettings initialUser={user} />);
    }

    const workoutsRoot = document.getElementById('react-workouts');
    if (workoutsRoot) {
        import('./Pages/Workouts').then(module => {
            const Workouts = module.default;
            createRoot(workoutsRoot).render(<Workouts />);
        });
    }

    const reportAnalysisRoot = document.getElementById('react-report-analysis');
    if (reportAnalysisRoot) {
        import('./Pages/ReportAnalysis').then(module => {
            const ReportAnalysis = module.default;
            createRoot(reportAnalysisRoot).render(<ReportAnalysis />);
        });
    }
});
