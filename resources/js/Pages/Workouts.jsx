import React, { useState, useEffect } from 'react';
import ThreeBackground from '../Components/ThreeBackground';
import { motion, AnimatePresence } from 'framer-motion';
import { Play, ArrowLeft, Upload, MessageCircle, Star, X, Flame, Activity, Clock, Heart } from 'lucide-react';

export default function Workouts() {
    const [activeTab, setActiveTab] = useState('home');
    const [communityWorkouts, setCommunityWorkouts] = useState([]);
    const [isUploadModalOpen, setIsUploadModalOpen] = useState(false);
    const [isReviewModalOpen, setIsReviewModalOpen] = useState(false);
    const [currentWorkoutId, setCurrentWorkoutId] = useState(null);

    const user = JSON.parse(document.getElementById('react-workouts').dataset.user);

    // Initial Workouts Data
    const homeWorkouts = [
        { id: 1, title: '15 Min Full Body HIIT', videoId: 'ml6cT4AZdqI', duration: '15 min', description: 'A fast-paced no-equipment routine to boost your heart rate.' },
        { id: 2, title: 'No Equipment Core Workout', videoId: 'dJlFmxiL11s', duration: '10 min', description: 'Build a stronger midsection.' },
        { id: 3, title: 'Beginner Yoga Flow', videoId: 'v7AYKMP6rOE', duration: '20 min', description: 'Improve flexibility and balance.' },
        { id: 4, title: 'Home Lower Body Burn', videoId: 'gCJqNmfRhdM', duration: '18 min', description: 'Squats, lunges, and glute bridges.' },
        { id: 5, title: 'Upper Body Strength Circuit', videoId: 'Bpp5ZXrZ7vA', duration: '16 min', description: 'Bodyweight upper body power.' },
        { id: 11, title: '10 Min Morning Stretch', videoId: 'sTANio_2E0Q', duration: '10 min', description: 'Start your day right with these simple stretches.' },
        { id: 12, title: 'Cardio Kickboxing', videoId: 'xSFw5TusyWk', duration: '25 min', description: 'Burn calories with this fun kickboxing routine.' },
        { id: 13, title: 'Pilates for Beginners', videoId: 'K-PpXCJSKW0', duration: '30 min', description: 'Core-focused low-impact workout.' },
        { id: 14, title: 'Standing Abs Workout', videoId: 'Eml2xnoLpYE', duration: '12 min', description: 'No mat required, standing core burn.' },
        { id: 15, title: 'Cool Down Routine', videoId: 'U_A_5tBf2C0', duration: '8 min', description: 'Essential stretches after any home workout.' },
    ];

    const gymWorkouts = [
        { id: 6, title: 'Complete Back & Biceps', videoId: 'mC3JvtLhNxc', duration: '45 min', description: 'Pair deadlifts, rows, and curls.' },
        { id: 7, title: 'Leg Day Motivation', videoId: 'RjexvOAsVtI', duration: '50 min', description: 'Squats, lunges, and leg presses.' },
        { id: 8, title: 'Chest & Triceps Routine', videoId: 'rxEMKXW2Wqs', duration: '40 min', description: 'Bench press, dips, and flyes.' },
        { id: 9, title: 'Dumbbell Full Body Strength', videoId: '2pLT-olgUJs', duration: '35 min', description: 'Total-body muscular conditioning.' },
        { id: 10, title: 'Compound Power Lift', videoId: 'r0nTBSLuiUY', duration: '42 min', description: 'Squats, deadlifts and presses.' },
        { id: 16, title: 'Cable Machine Only Workout', videoId: '69WqUa4FDEU', duration: '40 min', description: 'Full body workout using only cables.' },
        { id: 17, title: 'Shoulder Boulder Workout', videoId: 'bB4gI0qE3G4', duration: '45 min', description: 'Overhead presses, lateral raises, and face pulls.' },
        { id: 18, title: 'Gym Cardio HIIT', videoId: '54e9-Q6d79g', duration: '20 min', description: 'Treadmill, rower, and bike intervals.' },
        { id: 19, title: 'Glute Isolation Day', videoId: 'u431Yg_b_xQ', duration: '40 min', description: 'Hip thrusts, kickbacks, and abductions.' },
        { id: 20, title: 'Advanced Arm Day', videoId: 'z1m_xY1v_84', duration: '45 min', description: 'Supersets for massive arm pumps.' },
    ];

    useEffect(() => {
        fetchCommunityWorkouts();
    }, []);

    const fetchCommunityWorkouts = async () => {
        try {
            const response = await fetch('/api/workouts');
            const data = await response.json();
            setCommunityWorkouts(data);
        } catch (error) {
            console.error('Error fetching workouts:', error);
        }
    };

    return (
        <div className="min-h-screen bg-[#0f172a] text-slate-100 font-sans relative overflow-x-hidden">
            <div className="absolute inset-0 opacity-20 pointer-events-none">
                <ThreeBackground />
            </div>

            <div className="relative z-10 max-w-7xl mx-auto px-6 py-12">
                <a href="/dashboard" className="inline-flex items-center gap-2 text-slate-400 hover:text-white mb-8 transition">
                    <ArrowLeft size={20} />
                    <span>Back to Dashboard</span>
                </a>

                <div className="flex justify-between items-end mb-12">
                    <div>
                        <h1 className="text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#4CAF50] to-[#2196F3]">Workout Library</h1>
                        <p className="text-slate-400 text-lg">Curated routines and community-shared workouts.</p>
                    </div>
                    {activeTab === 'community' && (
                        <button 
                            onClick={() => setIsUploadModalOpen(true)}
                            className="bg-gradient-to-r from-[#4CAF50] to-[#2196F3] text-white px-6 py-3 rounded-xl font-medium shadow-lg hover:opacity-90 flex items-center gap-2 transition"
                        >
                            <Upload size={20} />
                            Upload Workout
                        </button>
                    )}
                </div>

                {/* Tabs */}
                <div className="flex gap-4 mb-10 border-b border-slate-700/50 pb-4 overflow-x-auto">
                    <button 
                        onClick={() => setActiveTab('home')}
                        className={`px-6 py-2 rounded-full font-medium transition ${activeTab === 'home' ? 'bg-[#4CAF50]/20 text-[#4CAF50] border border-[#4CAF50]/50' : 'text-slate-400 hover:text-white hover:bg-slate-800'}`}
                    >
                        🏠 Home Workouts
                    </button>
                    <button 
                        onClick={() => setActiveTab('gym')}
                        className={`px-6 py-2 rounded-full font-medium transition ${activeTab === 'gym' ? 'bg-blue-500/20 text-blue-400 border border-blue-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800'}`}
                    >
                        🏋️ Gym Workouts
                    </button>
                    <button 
                        onClick={() => setActiveTab('community')}
                        className={`px-6 py-2 rounded-full font-medium transition ${activeTab === 'community' ? 'bg-purple-500/20 text-purple-400 border border-purple-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800'}`}
                    >
                        🌍 Community Workouts
                    </button>
                    <button 
                        onClick={() => setActiveTab('challenges')}
                        className={`px-6 py-2 rounded-full font-medium transition ${activeTab === 'challenges' ? 'bg-orange-500/20 text-orange-400 border border-orange-500/50' : 'text-slate-400 hover:text-white hover:bg-slate-800'}`}
                    >
                        🔥 Wellness Challenges
                    </button>
                </div>

                <AnimatePresence mode="wait">
                    {/* Home Tab */}
                    {activeTab === 'home' && (
                        <motion.div key="home" initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -20 }}>
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {homeWorkouts.map(workout => (
                                    <WorkoutCard key={workout.id} workout={workout} />
                                ))}
                            </div>
                        </motion.div>
                    )}

                    {/* Gym Tab */}
                    {activeTab === 'gym' && (
                        <motion.div key="gym" initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -20 }}>
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                {gymWorkouts.map(workout => (
                                    <WorkoutCard key={workout.id} workout={workout} isGym />
                                ))}
                            </div>
                        </motion.div>
                    )}

                    {/* Community Tab */}
                    {activeTab === 'community' && (
                        <motion.div key="community" initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -20 }}>
                            {communityWorkouts.length === 0 ? (
                                <div className="text-center py-20 text-slate-400">
                                    <div className="text-6xl mb-4">🌍</div>
                                    <h3 className="text-2xl font-bold text-white mb-2">No community workouts yet!</h3>
                                    <p>Be the first to share your routine with the FitCommunity.</p>
                                </div>
                            ) : (
                                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                    {communityWorkouts.map(workout => (
                                        <CommunityWorkoutCard 
                                            key={workout.id} 
                                            workout={workout} 
                                            onReviewClick={() => { setCurrentWorkoutId(workout.id); setIsReviewModalOpen(true); }}
                                        />
                                    ))}
                                </div>
                            )}
                        </motion.div>
                    )}
                    {/* Challenges Tab */}
                    {activeTab === 'challenges' && (
                        <motion.div key="challenges" initial={{ opacity: 0, y: 20 }} animate={{ opacity: 1, y: 0 }} exit={{ opacity: 0, y: -20 }}>
                            <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <motion.div whileHover={{ scale: 1.02 }} className="bg-gradient-to-tr from-orange-500/20 to-red-500/20 border border-orange-500/30 rounded-2xl p-6 shadow-xl relative overflow-hidden group cursor-pointer">
                                    <div className="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                                        <Flame size={100} />
                                    </div>
                                    <h3 className="text-2xl font-bold text-orange-400 mb-2">7-Day Core & Clarity</h3>
                                    <p className="text-slate-300 mb-6">A holistic challenge blending 15-minute core workouts with daily 5-minute mindfulness sessions.</p>
                                    <div className="flex items-center gap-4 text-sm text-slate-400 mb-6">
                                        <span className="flex items-center gap-1"><Clock size={16} /> 7 Days</span>
                                        <span className="flex items-center gap-1"><Heart size={16} /> 1.2k Joined</span>
                                    </div>
                                    <button className="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-xl font-medium transition w-full">Join Challenge</button>
                                </motion.div>

                                <motion.div whileHover={{ scale: 1.02 }} className="bg-gradient-to-tr from-blue-500/20 to-cyan-500/20 border border-blue-500/30 rounded-2xl p-6 shadow-xl relative overflow-hidden group cursor-pointer">
                                    <div className="absolute top-0 right-0 p-4 opacity-10 group-hover:opacity-20 transition">
                                        <Activity size={100} />
                                    </div>
                                    <h3 className="text-2xl font-bold text-blue-400 mb-2">30-Day Step Journey</h3>
                                    <p className="text-slate-300 mb-6">Hit 10,000 steps a day for 30 days. Share your daily scenery photos in the community!</p>
                                    <div className="flex items-center gap-4 text-sm text-slate-400 mb-6">
                                        <span className="flex items-center gap-1"><Clock size={16} /> 30 Days</span>
                                        <span className="flex items-center gap-1"><Heart size={16} /> 5.4k Joined</span>
                                    </div>
                                    <button className="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-xl font-medium transition w-full">Join Challenge</button>
                                </motion.div>
                            </div>
                        </motion.div>
                    )}
                </AnimatePresence>
            </div>

            {/* Upload Modal */}
            <AnimatePresence>
                {isUploadModalOpen && (
                    <UploadModal 
                        onClose={() => setIsUploadModalOpen(false)} 
                        onSuccess={() => { setIsUploadModalOpen(false); fetchCommunityWorkouts(); }} 
                    />
                )}
                {isReviewModalOpen && (
                    <ReviewModal 
                        workoutId={currentWorkoutId}
                        onClose={() => setIsReviewModalOpen(false)} 
                        onSuccess={() => { setIsReviewModalOpen(false); fetchCommunityWorkouts(); }} 
                    />
                )}
            </AnimatePresence>
        </div>
    );
}

function WorkoutCard({ workout, isGym = false }) {
    return (
        <motion.div whileHover={{ y: -5 }} className="bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-2xl overflow-hidden shadow-lg group">
            <div className="relative aspect-video bg-black">
                <iframe 
                    className="w-full h-full" src={`https://www.youtube.com/embed/${workout.videoId}?controls=1`} 
                    title={workout.title} frameBorder="0" allowFullScreen>
                </iframe>
            </div>
            <div className="p-5">
                <h3 className={`font-bold text-lg mb-2 transition ${isGym ? 'group-hover:text-blue-400' : 'group-hover:text-[#4CAF50]'}`}>{workout.title}</h3>
                <p className="text-slate-400 text-sm mb-3">{workout.description}</p>
                <p className="text-slate-400 text-sm flex items-center gap-2">
                    <span className="p-1 rounded bg-slate-800 text-xs">⏱️ {workout.duration}</span>
                </p>
            </div>
        </motion.div>
    );
}

function CommunityWorkoutCard({ workout, onReviewClick }) {
    return (
        <motion.div whileHover={{ y: -5 }} className="bg-[#1e293b]/60 backdrop-blur-md border border-purple-500/30 rounded-2xl overflow-hidden shadow-lg group flex flex-col">
            <div className="relative aspect-video bg-black">
                {workout.video_path ? (
                    <video src={`/storage/workouts/videos/${workout.video_path}`} className="w-full h-full object-cover" controls></video>
                ) : (
                    <div className="w-full h-full flex items-center justify-center bg-slate-800 text-slate-500">No Video Available</div>
                )}
                <div className="absolute top-3 left-3 bg-black/60 px-2 py-1 rounded text-xs backdrop-blur-md">
                    By: {workout.user.name}
                </div>
            </div>
            <div className="p-5 flex-1 flex flex-col">
                <h3 className="font-bold text-lg mb-2 group-hover:text-purple-400 transition">{workout.title}</h3>
                <p className="text-slate-400 text-sm mb-3 flex-1">{workout.description}</p>
                
                <div className="flex items-center justify-between mt-4 pt-4 border-t border-slate-700/50">
                    <span className="p-1 rounded bg-slate-800 text-xs text-slate-300">⏱️ {workout.duration || 'N/A'}</span>
                    <button onClick={onReviewClick} className="flex items-center gap-1 text-purple-400 hover:text-purple-300 text-sm font-medium transition">
                        <MessageCircle size={16} /> 
                        {workout.reviews ? workout.reviews.length : 0} Reviews
                    </button>
                </div>

                {workout.reviews && workout.reviews.length > 0 && (
                    <div className="mt-3 bg-slate-800/50 p-3 rounded-lg">
                        <p className="text-xs text-slate-300 italic">"{workout.reviews[0].review}"</p>
                        <p className="text-[10px] text-slate-500 text-right mt-1">- {workout.reviews[0].user?.name}</p>
                    </div>
                )}
            </div>
        </motion.div>
    );
}

function UploadModal({ onClose, onSuccess }) {
    const [loading, setLoading] = useState(false);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        const formData = new FormData(e.target);
        
        try {
            const response = await fetch('/api/workouts', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            });
            if(response.ok) onSuccess();
            else alert('Failed to upload workout.');
        } catch (error) {
            console.error(error);
            alert('An error occurred.');
        }
        setLoading(false);
    };

    return (
        <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <motion.div initial={{ scale: 0.95 }} animate={{ scale: 1 }} exit={{ scale: 0.95 }} className="bg-[#1e293b] border border-slate-700 w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden">
                <div className="p-6 border-b border-slate-700 flex justify-between items-center bg-slate-800/50">
                    <h2 className="text-xl font-bold">Share Your Workout</h2>
                    <button onClick={onClose} className="text-slate-400 hover:text-white"><X size={24} /></button>
                </div>
                <form onSubmit={handleSubmit} className="p-6 space-y-4">
                    <div>
                        <label className="block text-sm font-medium text-slate-300 mb-1">Workout Title</label>
                        <input type="text" name="title" required className="w-full bg-[#0f172a] border border-slate-700 rounded-lg px-4 py-2 focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none" placeholder="e.g. My Killer Ab Routine" />
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-slate-300 mb-1">Description</label>
                        <textarea name="description" rows="3" className="w-full bg-[#0f172a] border border-slate-700 rounded-lg px-4 py-2 focus:border-purple-500 outline-none" placeholder="Explain your routine..."></textarea>
                    </div>
                    <div className="grid grid-cols-2 gap-4">
                        <div>
                            <label className="block text-sm font-medium text-slate-300 mb-1">Category</label>
                            <select name="category" className="w-full bg-[#0f172a] border border-slate-700 rounded-lg px-4 py-2 outline-none">
                                <option value="home">Home</option>
                                <option value="gym">Gym</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label className="block text-sm font-medium text-slate-300 mb-1">Duration</label>
                            <input type="text" name="duration" className="w-full bg-[#0f172a] border border-slate-700 rounded-lg px-4 py-2 outline-none" placeholder="e.g. 30 min" />
                        </div>
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-slate-300 mb-1">Video File (Optional)</label>
                        <input type="file" name="video" accept="video/*" className="w-full bg-[#0f172a] border border-slate-700 rounded-lg px-4 py-2 outline-none file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-500/20 file:text-purple-400 hover:file:bg-purple-500/30" />
                    </div>
                    <div className="pt-4">
                        <button type="submit" disabled={loading} className="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-medium transition disabled:opacity-50">
                            {loading ? 'Uploading...' : 'Publish Workout'}
                        </button>
                    </div>
                </form>
            </motion.div>
        </motion.div>
    );
}

function ReviewModal({ workoutId, onClose, onSuccess }) {
    const [loading, setLoading] = useState(false);
    const [rating, setRating] = useState(5);

    const handleSubmit = async (e) => {
        e.preventDefault();
        setLoading(true);
        const formData = new FormData(e.target);
        formData.append('rating', rating);
        
        try {
            const response = await fetch(`/api/workouts/${workoutId}/reviews`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });
            if(response.ok) onSuccess();
            else alert('Failed to submit review.');
        } catch (error) {
            console.error(error);
            alert('An error occurred.');
        }
        setLoading(false);
    };

    return (
        <motion.div initial={{ opacity: 0 }} animate={{ opacity: 1 }} exit={{ opacity: 0 }} className="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <motion.div initial={{ scale: 0.95 }} animate={{ scale: 1 }} exit={{ scale: 0.95 }} className="bg-[#1e293b] border border-slate-700 w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">
                <div className="p-6 border-b border-slate-700 flex justify-between items-center bg-slate-800/50">
                    <h2 className="text-xl font-bold">Write a Review</h2>
                    <button onClick={onClose} className="text-slate-400 hover:text-white"><X size={24} /></button>
                </div>
                <form onSubmit={handleSubmit} className="p-6 space-y-4">
                    <div>
                        <label className="block text-sm font-medium text-slate-300 mb-2">Rating</label>
                        <div className="flex gap-2">
                            {[1, 2, 3, 4, 5].map((star) => (
                                <button key={star} type="button" onClick={() => setRating(star)} className={`text-2xl focus:outline-none ${star <= rating ? 'text-yellow-400' : 'text-slate-600'}`}>★</button>
                            ))}
                        </div>
                    </div>
                    <div>
                        <label className="block text-sm font-medium text-slate-300 mb-1">Your Review</label>
                        <textarea name="review" required rows="4" className="w-full bg-[#0f172a] border border-slate-700 rounded-lg px-4 py-2 focus:border-purple-500 outline-none" placeholder="What did you think of this workout?"></textarea>
                    </div>
                    <div className="pt-4">
                        <button type="submit" disabled={loading} className="w-full bg-purple-600 hover:bg-purple-700 text-white py-3 rounded-lg font-medium transition disabled:opacity-50">
                            {loading ? 'Submitting...' : 'Submit Review'}
                        </button>
                    </div>
                </form>
            </motion.div>
        </motion.div>
    );
}
