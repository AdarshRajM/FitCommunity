import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { Activity, Video, Users, FileText, Search, Menu, LogOut, Bell, Upload, X } from 'lucide-react';
import ThreeBackground from '../Components/ThreeBackground';

export default function DoctorDashboard({ user, patients, reports }) {
    const [sidebarOpen, setSidebarOpen] = useState(true);
    const [selectedPatient, setSelectedPatient] = useState(null);
    const [isUploadModalOpen, setUploadModalOpen] = useState(false);

    const handlePatientClick = (patient) => {
        setSelectedPatient(patient);
    };

    return (
        <div className="flex h-screen bg-[#0f172a] text-slate-100 overflow-hidden font-sans">
            {/* 3D Background */}
            <div className="absolute inset-0 opacity-20 pointer-events-none">
                <ThreeBackground />
            </div>

            {/* Sidebar */}
            <motion.aside 
                initial={false}
                animate={{ width: sidebarOpen ? 280 : 80 }}
                className="relative z-20 h-full bg-[#1e293b]/80 backdrop-blur-xl border-r border-slate-700/50 flex flex-col transition-all duration-300"
            >
                <div className="p-6 flex items-center gap-4 border-b border-slate-700/50">
                    <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-500 to-indigo-500 flex items-center justify-center font-bold shadow-lg flex-shrink-0">
                        <Activity size={20} />
                    </div>
                    {sidebarOpen && <span className="text-xl font-bold tracking-tight whitespace-nowrap">Doctor Portal</span>}
                </div>

                <nav className="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                    <NavItem icon={<Users />} label="My Patients" active={true} open={sidebarOpen} />
                    <NavItem icon={<Video />} label="Telemedicine" active={false} open={sidebarOpen} />
                    <NavItem icon={<FileText />} label="Medical Reports" active={false} open={sidebarOpen} />
                </nav>

                <div className="p-4 border-t border-slate-700/50">
                    <form method="POST" action="/logout">
                        <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')} />
                        <button type="submit" className={`flex items-center gap-3 w-full p-3 rounded-xl hover:bg-red-500/10 hover:text-red-400 transition-colors ${sidebarOpen ? '' : 'justify-center'}`}>
                            <LogOut size={20} />
                            {sidebarOpen && <span className="font-medium">Logout</span>}
                        </button>
                    </form>
                </div>
            </motion.aside>

            {/* Main Content */}
            <main className="flex-1 flex flex-col h-full relative z-10 overflow-hidden">
                {/* Header */}
                <header className="h-20 bg-[#1e293b]/50 backdrop-blur-md border-b border-slate-700/50 flex items-center justify-between px-8">
                    <div className="flex items-center gap-4">
                        <button onClick={() => setSidebarOpen(!sidebarOpen)} className="p-2 text-slate-400 hover:text-white rounded-lg hover:bg-slate-800 transition-colors">
                            <Menu size={24} />
                        </button>
                        <h1 className="text-2xl font-bold hidden sm:block">Welcome, Dr. {user?.name}! 🩺</h1>
                    </div>

                    <div className="flex items-center gap-6">
                        <div className="relative hidden md:block">
                            <Search className="absolute left-3 top-1/2 -translate-y-1/2 text-slate-400" size={18} />
                            <input 
                                type="text" 
                                placeholder="Search patients..." 
                                className="bg-[#0f172a] border border-slate-700 rounded-full py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-blue-500 transition-colors w-64"
                            />
                        </div>
                        <button className="relative p-2 text-slate-400 hover:text-white transition-colors">
                            <Bell size={24} />
                        </button>
                        <div className="w-10 h-10 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-500 p-0.5 cursor-pointer hover:shadow-lg transition-shadow">
                            <img src={user?.avatar ? `/storage/${user.avatar}` : `https://ui-avatars.com/api/?name=${user?.name || 'Dr'}&background=random`} alt="Avatar" className="w-full h-full rounded-full border-2 border-[#1e293b]" />
                        </div>
                    </div>
                </header>

                <div className="flex-1 overflow-y-auto p-8 flex gap-8">
                    {/* Patient List */}
                    <div className="w-1/3 bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-3xl p-6 shadow-xl flex flex-col">
                        <h3 className="text-xl font-bold mb-6 flex items-center justify-between">
                            Patient Roster
                            <span className="text-sm font-normal text-slate-400 bg-slate-800 px-3 py-1 rounded-full">{patients.length} Total</span>
                        </h3>
                        <div className="flex-1 overflow-y-auto space-y-3 pr-2">
                            {patients.map(p => (
                                <div 
                                    key={p.id} 
                                    onClick={() => handlePatientClick(p)}
                                    className={`p-4 rounded-2xl cursor-pointer transition-all border ${selectedPatient?.id === p.id ? 'bg-blue-500/20 border-blue-500 shadow-[0_0_15px_rgba(59,130,246,0.3)]' : 'bg-[#0f172a] border-slate-700 hover:border-slate-500'}`}
                                >
                                    <div className="flex items-center gap-4">
                                        <div className="w-12 h-12 rounded-full bg-slate-800 flex-shrink-0 overflow-hidden">
                                            <img src={`https://ui-avatars.com/api/?name=${p.name}&background=random`} alt={p.name} />
                                        </div>
                                        <div>
                                            <h4 className="font-semibold text-slate-100">{p.name}</h4>
                                            <p className="text-xs text-slate-400">{p.email}</p>
                                        </div>
                                    </div>
                                </div>
                            ))}
                            {patients.length === 0 && (
                                <p className="text-center text-slate-500 mt-10">No patients found.</p>
                            )}
                        </div>
                    </div>

                    {/* Patient Details & Actions */}
                    <div className="flex-1 flex flex-col gap-6">
                        {selectedPatient ? (
                            <>
                                <motion.div 
                                    initial={{ opacity: 0, y: 20 }}
                                    animate={{ opacity: 1, y: 0 }}
                                    className="bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-3xl p-6 shadow-xl"
                                >
                                    <div className="flex justify-between items-start">
                                        <div className="flex items-center gap-6">
                                            <img src={`https://ui-avatars.com/api/?name=${selectedPatient.name}&background=random`} className="w-24 h-24 rounded-2xl border-4 border-[#0f172a] shadow-lg" alt="patient" />
                                            <div>
                                                <h2 className="text-3xl font-bold">{selectedPatient.name}</h2>
                                                <p className="text-slate-400 mt-1">{selectedPatient.email}</p>
                                                <div className="flex gap-3 mt-3">
                                                    <span className="px-3 py-1 bg-slate-800 border border-slate-700 rounded-full text-xs font-medium text-slate-300">
                                                        Blood: {selectedPatient.profile?.blood_group || 'Unknown'}
                                                    </span>
                                                    <span className="px-3 py-1 bg-slate-800 border border-slate-700 rounded-full text-xs font-medium text-slate-300">
                                                        Gender: {selectedPatient.profile?.gender || 'Unknown'}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div className="flex gap-3">
                                            <a href={`/telemedicine/room/${selectedPatient.id}`} className="flex items-center gap-2 px-5 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:from-blue-600 hover:to-indigo-600 rounded-xl font-medium shadow-lg hover:shadow-blue-500/25 transition-all text-white">
                                                <Video size={18} /> Start Call
                                            </a>
                                        </div>
                                    </div>

                                    <div className="mt-8 grid grid-cols-2 gap-6">
                                        <div className="bg-[#0f172a] p-5 rounded-2xl border border-slate-700">
                                            <h4 className="text-sm font-semibold text-slate-400 mb-3 flex items-center gap-2"><Activity size={16}/> Medical History</h4>
                                            <p className="text-sm">{selectedPatient.profile?.medical_history || 'No medical history provided.'}</p>
                                        </div>
                                        <div className="bg-[#0f172a] p-5 rounded-2xl border border-slate-700">
                                            <h4 className="text-sm font-semibold text-slate-400 mb-3 flex items-center gap-2"><AlertTriangle size={16}/> Allergies</h4>
                                            <p className="text-sm">{selectedPatient.profile?.allergies || 'No known allergies.'}</p>
                                        </div>
                                    </div>
                                </motion.div>

                                {/* Reports Section */}
                                <motion.div 
                                    initial={{ opacity: 0, y: 20 }}
                                    animate={{ opacity: 1, y: 0 }}
                                    transition={{ delay: 0.1 }}
                                    className="bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-3xl p-6 shadow-xl flex-1 flex flex-col"
                                >
                                    <div className="flex justify-between items-center mb-6">
                                        <h3 className="text-xl font-bold flex items-center gap-2"><FileText /> Medical Reports</h3>
                                        <button onClick={() => setUploadModalOpen(true)} className="flex items-center gap-2 px-4 py-2 bg-slate-800 hover:bg-slate-700 border border-slate-600 rounded-lg text-sm transition-colors">
                                            <Upload size={16} /> Upload New Report
                                        </button>
                                    </div>

                                    <div className="space-y-4 overflow-y-auto">
                                        {reports.filter(r => r.patient_id === selectedPatient.id).map(r => (
                                            <div key={r.id} className="flex justify-between items-center p-4 bg-[#0f172a] border border-slate-700 rounded-xl hover:border-slate-500 transition-colors">
                                                <div>
                                                    <h5 className="font-semibold">{r.title}</h5>
                                                    <p className="text-xs text-slate-400 mt-1">{new Date(r.created_at).toLocaleDateString()} - {r.diagnosis}</p>
                                                </div>
                                                {r.file_path && (
                                                    <a href={`/storage/${r.file_path}`} target="_blank" rel="noreferrer" className="text-blue-400 hover:text-blue-300 text-sm font-medium">Download</a>
                                                )}
                                            </div>
                                        ))}
                                        {reports.filter(r => r.patient_id === selectedPatient.id).length === 0 && (
                                            <p className="text-center text-slate-500 py-8">No reports uploaded for this patient yet.</p>
                                        )}
                                    </div>
                                </motion.div>
                            </>
                        ) : (
                            <div className="flex-1 flex flex-col items-center justify-center bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-3xl p-6 shadow-xl text-center">
                                <Users size={64} className="text-slate-600 mb-4" />
                                <h2 className="text-2xl font-bold text-slate-300">Select a Patient</h2>
                                <p className="text-slate-500 mt-2">Click on a patient from the roster to view their medical history, upload reports, or initiate a video call.</p>
                            </div>
                        )}
                    </div>
                </div>
            </main>

            {/* Upload Modal */}
            {isUploadModalOpen && (
                <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm px-4">
                    <motion.div 
                        initial={{ opacity: 0, scale: 0.95 }}
                        animate={{ opacity: 1, scale: 1 }}
                        className="bg-[#1e293b] border border-slate-700 rounded-3xl p-8 max-w-lg w-full shadow-2xl relative"
                    >
                        <button onClick={() => setUploadModalOpen(false)} className="absolute top-6 right-6 text-slate-400 hover:text-white">
                            <X size={24} />
                        </button>
                        <h2 className="text-2xl font-bold mb-6">Upload Medical Report</h2>
                        <form action="/doctor/report" method="POST" encType="multipart/form-data" className="space-y-4">
                            <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')} />
                            <input type="hidden" name="patient_id" value={selectedPatient?.id} />

                            <div>
                                <label className="block text-sm font-medium text-slate-400 mb-1">Report Title</label>
                                <input type="text" name="title" required className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 transition-colors" placeholder="e.g. Blood Test Results" />
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-slate-400 mb-1">Diagnosis / Notes</label>
                                <textarea name="diagnosis" required rows="3" className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500 transition-colors" placeholder="Doctor's notes..."></textarea>
                            </div>

                            <div>
                                <label className="block text-sm font-medium text-slate-400 mb-1">Attach File (PDF/Image)</label>
                                <input type="file" name="report_file" accept=".pdf,.jpg,.png" className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-2 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-500/20 file:text-blue-400 hover:file:bg-blue-500/30 transition-colors" />
                            </div>

                            <button type="submit" className="w-full mt-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 hover:opacity-90 rounded-xl font-semibold shadow-lg text-white transition-opacity">
                                Save Report
                            </button>
                        </form>
                    </motion.div>
                </div>
            )}
        </div>
    );
}

function NavItem({ icon, label, active, open }) {
    return (
        <a href="#" className={`flex items-center gap-3 p-3 rounded-xl transition-all ${active ? 'bg-gradient-to-r from-blue-500/20 to-indigo-500/20 text-blue-400 border border-blue-500/30' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200'} ${open ? '' : 'justify-center'}`}>
            <div>{icon}</div>
            {open && <span className="font-medium whitespace-nowrap">{label}</span>}
        </a>
    );
}
