import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { User, Shield, HeartPulse, FileText, Bell, Save, AlertTriangle } from 'lucide-react';
import axios from 'axios';

export default function ProfileSettings({ initialUser }) {
    const [user, setUser] = useState(initialUser);
    const [activeTab, setActiveTab] = useState('general');
    const [isLoading, setIsLoading] = useState(false);
    const [message, setMessage] = useState({ text: '', type: '' });

    // Initialize form data, gracefully handling missing profile relations
    const [formData, setFormData] = useState({
        name: user?.name || '',
        email: user?.email || '',
        age: user?.profile?.age || '',
        height: user?.profile?.height || '',
        weight: user?.profile?.weight || '',
        gender: user?.profile?.gender || '',
        blood_group: user?.profile?.blood_group || '',
        skin_color: user?.profile?.skin_color || '',
        medical_history: user?.profile?.medical_history || '',
        allergies: user?.profile?.allergies || '',
        emergency_contact_name: user?.profile?.emergency_contact_name || '',
        emergency_contact_phone: user?.profile?.emergency_contact_phone || '',
        fitness_goal: user?.profile?.fitness_goal || '',
        activity_level: user?.profile?.activity_level || '',
        dietary_preference: user?.profile?.dietary_preference || ''
    });

    const [avatarFile, setAvatarFile] = useState(null);
    const [previewUrl, setPreviewUrl] = useState(user?.avatar ? `/storage/${user.avatar}` : 'https://ui-avatars.com/api/?name=' + (user?.name || 'User') + '&background=random');

    const handleInputChange = (e) => {
        const { name, value } = e.target;
        setFormData(prev => ({ ...prev, [name]: value }));
    };

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        if (file) {
            setAvatarFile(file);
            setPreviewUrl(URL.createObjectURL(file));
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setIsLoading(true);
        setMessage({ text: '', type: '' });

        const data = new FormData();
        Object.keys(formData).forEach(key => {
            if (formData[key] !== null && formData[key] !== undefined) {
                data.append(key, formData[key]);
            }
        });
        
        if (avatarFile) {
            data.append('avatar', avatarFile);
        }

        // Laravel requires _method=PATCH for multipart/form-data updates sometimes, 
        // but since we post to a PATCH route, let's append _method
        data.append('_method', 'PATCH');

        try {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const response = await axios.post('/profile', data, {
                headers: {
                    'X-CSRF-TOKEN': token,
                    'Content-Type': 'multipart/form-data',
                    'Accept': 'application/json'
                }
            });

            setMessage({ text: 'Profile updated successfully!', type: 'success' });
            setUser(response.data.user);
        } catch (error) {
            setMessage({ 
                text: error.response?.data?.message || 'An error occurred while updating profile.', 
                type: 'error' 
            });
        } finally {
            setIsLoading(false);
            // Hide message after 3 seconds
            setTimeout(() => setMessage({ text: '', type: '' }), 3000);
        }
    };

    const tabStyles = (tabName) => `flex items-center gap-3 w-full p-4 rounded-xl transition-all text-left font-medium ${activeTab === tabName ? 'bg-gradient-to-r from-[#4CAF50] to-[#2196F3] text-white shadow-lg shadow-[#4CAF50]/20' : 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200'}`;

    return (
        <div className="min-h-screen bg-[#0f172a] text-slate-100 font-sans p-6 md:p-12 relative overflow-hidden">
            {/* Background glowing effects */}
            <div className="absolute top-0 right-0 w-[500px] h-[500px] bg-[#4CAF50] rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>
            <div className="absolute bottom-0 left-0 w-[500px] h-[500px] bg-[#2196F3] rounded-full mix-blend-screen filter blur-[150px] opacity-10 pointer-events-none"></div>

            <div className="max-w-6xl mx-auto relative z-10">
                <div className="mb-8 flex items-center justify-between">
                    <div>
                        <h1 className="text-3xl font-bold tracking-tight mb-2">Advanced Settings</h1>
                        <p className="text-slate-400">Manage your profile, medical history, and account preferences.</p>
                    </div>
                    <a href="/dashboard" className="px-5 py-2 rounded-xl bg-slate-800 hover:bg-slate-700 transition border border-slate-700 text-sm font-medium">
                        Back to Dashboard
                    </a>
                </div>

                {message.text && (
                    <motion.div 
                        initial={{ opacity: 0, y: -20 }}
                        animate={{ opacity: 1, y: 0 }}
                        className={`p-4 rounded-xl mb-6 flex items-center gap-3 border ${message.type === 'success' ? 'bg-[#4CAF50]/10 border-[#4CAF50]/50 text-[#4CAF50]' : 'bg-red-500/10 border-red-500/50 text-red-500'}`}
                    >
                        {message.type === 'error' && <AlertTriangle size={20} />}
                        {message.text}
                    </motion.div>
                )}

                <div className="flex flex-col md:flex-row gap-8">
                    {/* Settings Navigation */}
                    <div className="w-full md:w-64 space-y-2 flex-shrink-0">
                        <button onClick={() => setActiveTab('general')} className={tabStyles('general')}>
                            <User size={20} /> General Profile
                        </button>
                        <button onClick={() => setActiveTab('medical')} className={tabStyles('medical')}>
                            <HeartPulse size={20} /> Medical & Health
                        </button>
                        <button onClick={() => setActiveTab('fitness')} className={tabStyles('fitness')}>
                            <FileText size={20} /> Fitness Goals
                        </button>
                        <button onClick={() => setActiveTab('security')} className={tabStyles('security')}>
                            <Shield size={20} /> Security & Roles
                        </button>
                    </div>

                    {/* Settings Content Area */}
                    <div className="flex-1 bg-[#1e293b]/60 backdrop-blur-xl border border-slate-700/50 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                        <form onSubmit={handleSubmit}>
                            
                            {/* General Profile Tab */}
                            {activeTab === 'general' && (
                                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} className="space-y-6">
                                    <h2 className="text-2xl font-bold border-b border-slate-700/50 pb-4 mb-6">General Information</h2>
                                    
                                    {/* Avatar Upload */}
                                    <div className="flex items-center gap-6 mb-8">
                                        <div className="relative">
                                            <img src={previewUrl} alt="Profile" className="w-24 h-24 rounded-full object-cover border-4 border-[#0f172a] shadow-xl" />
                                            <label className="absolute bottom-0 right-0 bg-[#2196F3] p-2 rounded-full cursor-pointer hover:bg-blue-600 transition shadow-lg">
                                                <svg className="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path></svg>
                                                <input type="file" className="hidden" accept="image/*" onChange={handleFileChange} />
                                            </label>
                                        </div>
                                        <div>
                                            <h3 className="font-medium text-lg">Profile Picture</h3>
                                            <p className="text-sm text-slate-400">Upload a new avatar. Max size 2MB.</p>
                                        </div>
                                    </div>

                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <FormInput label="Full Name" name="name" value={formData.name} onChange={handleInputChange} required />
                                        <FormInput label="Email Address" name="email" type="email" value={formData.email} onChange={handleInputChange} required />
                                        <FormInput label="Age" name="age" type="number" value={formData.age} onChange={handleInputChange} />
                                        <div className="space-y-2">
                                            <label className="text-sm font-medium text-slate-300">Gender</label>
                                            <select name="gender" value={formData.gender} onChange={handleInputChange} className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors">
                                                <option value="">Select Gender</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </motion.div>
                            )}

                            {/* Medical & Health Tab */}
                            {activeTab === 'medical' && (
                                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} className="space-y-6">
                                    <h2 className="text-2xl font-bold border-b border-slate-700/50 pb-4 mb-6 text-red-400 flex items-center gap-2">
                                        <HeartPulse /> Medical Records & Emergency
                                    </h2>
                                    <p className="text-sm text-slate-400 mb-6">Providing this information helps our AI Doctor and medical professionals give you the best possible advice.</p>
                                    
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <FormInput label="Blood Group" name="blood_group" value={formData.blood_group} onChange={handleInputChange} placeholder="e.g., O+, A-" />
                                        <FormInput label="Skin Color / Complexion" name="skin_color" value={formData.skin_color} onChange={handleInputChange} placeholder="e.g., Fair, Medium, Dark" />
                                        
                                        <div className="md:col-span-2 space-y-2">
                                            <label className="text-sm font-medium text-slate-300">Medical History</label>
                                            <textarea name="medical_history" value={formData.medical_history} onChange={handleInputChange} rows="3" placeholder="Any past surgeries, chronic illnesses, etc." className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors"></textarea>
                                        </div>

                                        <div className="md:col-span-2 space-y-2">
                                            <label className="text-sm font-medium text-slate-300">Allergies</label>
                                            <textarea name="allergies" value={formData.allergies} onChange={handleInputChange} rows="2" placeholder="List any known allergies (food, medication, etc.)" className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors"></textarea>
                                        </div>

                                        <h3 className="md:col-span-2 text-lg font-semibold mt-4 text-slate-300">Emergency Contact</h3>
                                        <FormInput label="Contact Name" name="emergency_contact_name" value={formData.emergency_contact_name} onChange={handleInputChange} />
                                        <FormInput label="Contact Phone" name="emergency_contact_phone" value={formData.emergency_contact_phone} onChange={handleInputChange} />
                                    </div>
                                </motion.div>
                            )}

                            {/* Fitness Goals Tab */}
                            {activeTab === 'fitness' && (
                                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} className="space-y-6">
                                    <h2 className="text-2xl font-bold border-b border-slate-700/50 pb-4 mb-6 text-[#4CAF50]">Physical Profile & Goals</h2>
                                    
                                    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <FormInput label="Height (cm)" name="height" type="number" value={formData.height} onChange={handleInputChange} />
                                        <FormInput label="Weight (kg)" name="weight" type="number" value={formData.weight} onChange={handleInputChange} />
                                        
                                        <div className="space-y-2">
                                            <label className="text-sm font-medium text-slate-300">Fitness Goal</label>
                                            <select name="fitness_goal" value={formData.fitness_goal} onChange={handleInputChange} className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors">
                                                <option value="">Select Goal</option>
                                                <option value="weight_loss">Weight Loss</option>
                                                <option value="muscle_gain">Muscle Gain</option>
                                                <option value="maintenance">Maintenance</option>
                                                <option value="endurance">Endurance/Stamina</option>
                                            </select>
                                        </div>

                                        <div className="space-y-2">
                                            <label className="text-sm font-medium text-slate-300">Activity Level</label>
                                            <select name="activity_level" value={formData.activity_level} onChange={handleInputChange} className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors">
                                                <option value="">Select Level</option>
                                                <option value="sedentary">Sedentary (Little to no exercise)</option>
                                                <option value="light">Lightly Active (1-3 days/week)</option>
                                                <option value="moderate">Moderately Active (3-5 days/week)</option>
                                                <option value="very_active">Very Active (6-7 days/week)</option>
                                            </select>
                                        </div>

                                        <div className="md:col-span-2 space-y-2">
                                            <label className="text-sm font-medium text-slate-300">Dietary Preference</label>
                                            <select name="dietary_preference" value={formData.dietary_preference} onChange={handleInputChange} className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors">
                                                <option value="">Select Preference</option>
                                                <option value="none">No Restrictions</option>
                                                <option value="vegetarian">Vegetarian</option>
                                                <option value="vegan">Vegan</option>
                                                <option value="keto">Keto</option>
                                                <option value="paleo">Paleo</option>
                                                <option value="halal">Halal</option>
                                            </select>
                                        </div>
                                    </div>
                                </motion.div>
                            )}

                            {/* Security Tab */}
                            {activeTab === 'security' && (
                                <motion.div initial={{ opacity: 0, x: 20 }} animate={{ opacity: 1, x: 0 }} className="space-y-6">
                                    <h2 className="text-2xl font-bold border-b border-slate-700/50 pb-4 mb-6">Security & Account</h2>
                                    <div className="bg-[#0f172a] border border-slate-700 rounded-2xl p-6">
                                        <h3 className="text-lg font-semibold mb-2">Password Update</h3>
                                        <p className="text-sm text-slate-400 mb-4">To update your password, please use the dedicated security portal. Coming soon in Phase 5.</p>
                                        <button type="button" className="px-4 py-2 bg-slate-800 rounded-lg text-sm opacity-50 cursor-not-allowed">Update Password</button>
                                    </div>

                                    <div className="bg-red-500/10 border border-red-500/30 rounded-2xl p-6">
                                        <h3 className="text-lg font-semibold text-red-400 mb-2">Danger Zone</h3>
                                        <p className="text-sm text-slate-400 mb-4">Once you delete your account, there is no going back. Please be certain.</p>
                                        <button type="button" className="px-4 py-2 bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white transition rounded-lg text-sm font-medium">Delete Account</button>
                                    </div>
                                </motion.div>
                            )}

                            {/* Sticky Save Button */}
                            <div className="mt-8 pt-6 border-t border-slate-700/50 flex justify-end">
                                <button 
                                    type="submit" 
                                    disabled={isLoading}
                                    className="px-8 py-3 bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] text-white rounded-xl font-bold shadow-lg shadow-[#4CAF50]/30 hover:scale-105 transition-all flex items-center gap-2 disabled:opacity-70 disabled:scale-100"
                                >
                                    {isLoading ? (
                                        <div className="w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></div>
                                    ) : (
                                        <><Save size={20} /> Save Changes</>
                                    )}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    );
}

function FormInput({ label, name, type = "text", value, onChange, required, placeholder }) {
    return (
        <div className="space-y-2">
            <label className="text-sm font-medium text-slate-300">
                {label} {required && <span className="text-red-400">*</span>}
            </label>
            <input 
                type={type} 
                name={name} 
                value={value || ''} 
                onChange={onChange} 
                required={required}
                placeholder={placeholder}
                className="w-full bg-[#0f172a] border border-slate-700 rounded-xl px-4 py-3 text-slate-200 focus:outline-none focus:border-[#4CAF50] transition-colors"
            />
        </div>
    );
}
