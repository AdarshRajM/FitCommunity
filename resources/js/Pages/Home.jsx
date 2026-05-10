import React, { useEffect } from 'react';
import ThreeBackground from '../Components/ThreeBackground';
import AIDoctor from '../Components/AIDoctor';
import { motion } from 'framer-motion';
import { Activity, Users, CalendarHeart, ArrowRight } from 'lucide-react';

export default function Home() {
    return (
        <div className="relative min-h-screen font-sans bg-[#0f172a] text-slate-100 overflow-hidden">
            {/* 3D Background */}
            <ThreeBackground />

            {/* Navigation Placeholder */}
            <nav className="fixed w-full z-50 bg-[#0f172a]/60 backdrop-blur-xl border-b border-white/5 py-4 px-6 md:px-12 transition-all duration-300">
                <div className="max-w-7xl mx-auto flex justify-between items-center">
                    <div className="flex items-center gap-2">
                        <div className="w-10 h-10 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center font-bold text-xl shadow-lg shadow-green-500/20">
                            F
                        </div>
                        <span className="text-2xl font-bold tracking-tight">Fit<span className="text-[#4CAF50]">Community</span></span>
                    </div>
                    
                    <div className="hidden md:flex gap-8 items-center font-medium text-sm text-slate-300">
                        <a href="#features" className="hover:text-white transition-colors">Features</a>
                        <a href="#community" className="hover:text-white transition-colors">Community</a>
                        <a href="#about" className="hover:text-white transition-colors">About Us</a>
                    </div>

                    <div className="flex gap-4 items-center">
                        <a href="/login" className="text-slate-300 hover:text-white font-medium text-sm transition-colors">Log in</a>
                        <a href="/register" className="bg-gradient-to-r from-[#4CAF50] to-[#2b9d50] hover:scale-105 transition-transform px-6 py-2 rounded-full font-medium text-sm shadow-lg shadow-green-500/30 text-white">Join Now</a>
                    </div>
                </div>
            </nav>

            {/* Hero Section */}
            <section className="relative min-h-screen flex items-center justify-center pt-20 px-6 z-10">
                <div className="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 items-center w-full">
                    <motion.div 
                        initial={{ opacity: 0, y: 30 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.8, ease: "easeOut" }}
                        className="text-left"
                    >
                        <div className="inline-flex items-center px-4 py-1.5 rounded-full bg-green-500/10 border border-green-500/20 text-sm font-medium text-[#4CAF50] mb-6 backdrop-blur-md">
                            <span className="w-2 h-2 rounded-full bg-green-500 mr-2 animate-pulse"></span>
                            The Future of Health & Wellness
                        </div>
                        <h1 className="text-5xl md:text-7xl font-extrabold leading-tight mb-6 tracking-tight">
                            Elevate Your <br/>
                            <span className="bg-clip-text text-transparent bg-gradient-to-r from-[#4CAF50] to-[#2196F3]">Well-being.</span>
                        </h1>
                        <p className="text-slate-400 text-lg md:text-xl mb-8 max-w-lg font-light leading-relaxed">
                            Join our advanced digital wellness community. Connect with peers, consult our AI Doctor, and achieve your health goals in a stunning interactive environment.
                        </p>
                        <div className="flex flex-wrap gap-4">
                            <a href="/register" className="group bg-gradient-to-r from-[#4CAF50] to-[#2b9d50] hover:from-[#45a049] hover:to-[#228642] px-8 py-3.5 rounded-full font-semibold text-lg flex items-center gap-2 transition-all shadow-xl shadow-green-500/25 hover:shadow-green-500/40 transform hover:-translate-y-1">
                                Start Your Journey
                                <ArrowRight className="w-5 h-5 group-hover:translate-x-1 transition-transform" />
                            </a>
                            <a href="#features" className="px-8 py-3.5 rounded-full font-semibold text-lg border border-slate-600 hover:bg-slate-800/50 hover:border-slate-400 transition-all backdrop-blur-sm">
                                Explore Features
                            </a>
                        </div>
                        
                        <div className="mt-12 flex items-center gap-6 text-slate-400 text-sm border-t border-white/10 pt-8 w-max">
                            <div className="flex -space-x-4">
                                <img className="w-10 h-10 rounded-full border-2 border-[#0f172a]" src="https://i.pravatar.cc/100?img=1" alt="User" />
                                <img className="w-10 h-10 rounded-full border-2 border-[#0f172a]" src="https://i.pravatar.cc/100?img=2" alt="User" />
                                <img className="w-10 h-10 rounded-full border-2 border-[#0f172a]" src="https://i.pravatar.cc/100?img=3" alt="User" />
                                <div className="w-10 h-10 rounded-full border-2 border-[#0f172a] bg-slate-800 flex items-center justify-center text-xs font-bold text-white shadow-inner">+5k</div>
                            </div>
                            <p>Active members<br/>thriving together.</p>
                        </div>
                    </motion.div>
                </div>
            </section>

            {/* Features Section */}
            <section id="features" className="py-24 relative z-10 bg-[#0b1121]/80 backdrop-blur-md border-t border-white/5">
                <div className="max-w-7xl mx-auto px-6">
                    <motion.div 
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        className="text-center mb-20"
                    >
                        <h2 className="text-4xl md:text-5xl font-bold mb-4">A Holistic <span className="bg-clip-text text-transparent bg-gradient-to-r from-[#4CAF50] to-[#2196F3]">Ecosystem</span></h2>
                        <p className="text-slate-400 max-w-2xl mx-auto text-lg">Everything you need to manage your physical, mental, and emotional health proactively.</p>
                    </motion.div>

                    <div className="grid md:grid-cols-3 gap-8">
                        {/* Feature 1 */}
                        <motion.div 
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: 0.1 }}
                            className="bg-[#1e293b]/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-green-500/10 group"
                        >
                            <div className="w-14 h-14 rounded-2xl bg-green-500/10 flex items-center justify-center mb-6 text-[#4CAF50] group-hover:scale-110 transition-transform">
                                <Activity size={32} />
                            </div>
                            <h3 className="text-2xl font-semibold mb-3 text-slate-100">Smart Health Tracking</h3>
                            <p className="text-slate-400 leading-relaxed">Log vitals like BMI, blood pressure, and sleep. Get personalized insights powered by our AI engine.</p>
                        </motion.div>

                        {/* Feature 2 */}
                        <motion.div 
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: 0.2 }}
                            className="bg-[#1e293b]/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10 group relative overflow-hidden"
                        >
                            <div className="absolute -right-10 -top-10 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl"></div>
                            <div className="w-14 h-14 rounded-2xl bg-blue-500/10 flex items-center justify-center mb-6 text-[#2196F3] group-hover:scale-110 transition-transform relative z-10">
                                <Users size={32} />
                            </div>
                            <h3 className="text-2xl font-semibold mb-3 relative z-10 text-slate-100">Peer Support Forums</h3>
                            <p className="text-slate-400 leading-relaxed relative z-10">Connect with others facing similar health challenges. Share experiences and find emotional encouragement.</p>
                        </motion.div>

                        {/* Feature 3 */}
                        <motion.div 
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: 0.3 }}
                            className="bg-[#1e293b]/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/10 group"
                        >
                            <div className="w-14 h-14 rounded-2xl bg-purple-500/10 flex items-center justify-center mb-6 text-purple-400 group-hover:scale-110 transition-transform">
                                <CalendarHeart size={32} />
                            </div>
                            <h3 className="text-2xl font-semibold mb-3 text-slate-100">Virtual Wellness</h3>
                            <p className="text-slate-400 leading-relaxed">Join structured classes for fitness, mindfulness, and nutrition led by verified experts.</p>
                        </motion.div>
                    </div>
                </div>
            </section>

            <section id="health-content" className="py-24 relative z-10 bg-[#0b1121]/80 backdrop-blur-md border-t border-white/5">
                <div className="max-w-7xl mx-auto px-6">
                    <motion.div 
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        className="text-center mb-16"
                    >
                        <h2 className="text-4xl md:text-5xl font-bold mb-4">Daily Health Essentials</h2>
                        <p className="text-slate-400 max-w-2xl mx-auto text-lg">Simple, evidence-informed guidance to support your nutrition, recovery, and long-term fitness.</p>
                    </motion.div>

                    <div className="grid md:grid-cols-3 gap-8">
                        <motion.div 
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: 0.1 }}
                            className="bg-[#1e293b]/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-green-500/10"
                        >
                            <h3 className="text-2xl font-semibold mb-3 text-slate-100">Nutrition for Energy</h3>
                            <p className="text-slate-400 leading-relaxed">Prioritize whole foods, lean protein, healthy fats, and vegetables. A balanced plate helps maintain energy and supports workout recovery.</p>
                        </motion.div>
                        <motion.div 
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: 0.2 }}
                            className="bg-[#1e293b]/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-blue-500/10"
                        >
                            <h3 className="text-2xl font-semibold mb-3 text-slate-100">Hydration Matters</h3>
                            <p className="text-slate-400 leading-relaxed">Drink water consistently throughout the day, especially before and after workouts. Hydration supports digestion, focus, and muscle performance.</p>
                        </motion.div>
                        <motion.div 
                            initial={{ opacity: 0, y: 20 }}
                            whileInView={{ opacity: 1, y: 0 }}
                            viewport={{ once: true }}
                            transition={{ delay: 0.3 }}
                            className="bg-[#1e293b]/50 backdrop-blur-sm p-8 rounded-3xl border border-slate-700/50 hover:-translate-y-2 transition-all duration-300 hover:shadow-2xl hover:shadow-purple-500/10"
                        >
                            <h3 className="text-2xl font-semibold mb-3 text-slate-100">Rest & Recovery</h3>
                            <p className="text-slate-400 leading-relaxed">Aim for 7–9 hours of sleep and add light stretching on rest days. Recovery is where your body rebuilds stronger after exercise.</p>
                        </motion.div>
                    </div>
                </div>
            </section>
            {/* How It Works Section */}
            <section className="py-24 relative z-10">
                <div className="max-w-7xl mx-auto px-6">
                    <motion.div 
                        initial={{ opacity: 0, y: 20 }}
                        whileInView={{ opacity: 1, y: 0 }}
                        viewport={{ once: true }}
                        className="text-center mb-16"
                    >
                        <h2 className="text-3xl md:text-5xl font-bold mb-4">How <span className="text-[#4CAF50]">FitCommunity</span> Works</h2>
                        <p className="text-slate-400">Your health journey simplified into three easy steps.</p>
                    </motion.div>

                    <div className="grid md:grid-cols-3 gap-12 relative">
                        {/* Connecting Line */}
                        <div className="hidden md:block absolute top-1/2 left-[10%] right-[10%] h-0.5 bg-gradient-to-r from-[#4CAF50]/10 via-[#2196F3]/30 to-purple-500/10 -z-10"></div>

                        <div className="text-center relative">
                            <div className="w-16 h-16 rounded-full bg-gradient-to-br from-[#4CAF50] to-[#2b9d50] flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 shadow-lg shadow-green-500/30">1</div>
                            <h4 className="text-xl font-semibold mb-2">Create Profile</h4>
                            <p className="text-slate-400 text-sm">Sign up and log your baseline metrics. Set your health goals instantly.</p>
                        </div>
                        <div className="text-center relative">
                            <div className="w-16 h-16 rounded-full bg-gradient-to-br from-[#2196F3] to-[#1e88e5] flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 shadow-lg shadow-blue-500/30">2</div>
                            <h4 className="text-xl font-semibold mb-2">Engage & Track</h4>
                            <p className="text-slate-400 text-sm">Use our dashboard to log daily habits and chat with our AI for instant advice.</p>
                        </div>
                        <div className="text-center relative">
                            <div className="w-16 h-16 rounded-full bg-gradient-to-br from-purple-500 to-purple-700 flex items-center justify-center text-white text-2xl font-bold mx-auto mb-6 shadow-lg shadow-purple-500/30">3</div>
                            <h4 className="text-xl font-semibold mb-2">Consult Experts</h4>
                            <p className="text-slate-400 text-sm">Book live telemedicine calls with verified doctors when you need professional help.</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-[#0b1121] border-t border-white/10 pt-16 pb-8 relative z-10">
                <div className="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                    <div className="col-span-1 md:col-span-2">
                        <div className="flex items-center gap-2 mb-4">
                            <div className="w-8 h-8 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center font-bold text-white shadow-lg">F</div>
                            <span className="text-xl font-bold tracking-tight">Fit<span className="text-[#4CAF50]">Community</span></span>
                        </div>
                        <p className="text-slate-400 text-sm max-w-sm mb-6">Building a healthier world, one connection at a time. The ultimate platform merging AI, Community, and Telemedicine.</p>
                        <div className="flex gap-4">
                            <a href="#" className="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#4CAF50] hover:text-white transition-colors">𝕏</a>
                            <a href="#" className="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 hover:bg-[#2196F3] hover:text-white transition-colors">in</a>
                        </div>
                    </div>
                    <div>
                        <h4 className="font-semibold mb-4 text-slate-200">Platform</h4>
                        <ul className="space-y-2 text-sm text-slate-400">
                            <li><a href="/login" className="hover:text-[#4CAF50] transition-colors">Login</a></li>
                            <li><a href="/register" className="hover:text-[#4CAF50] transition-colors">Register</a></li>
                            <li><a href="#features" className="hover:text-[#4CAF50] transition-colors">Features</a></li>
                            <li><a href="/community" className="hover:text-[#4CAF50] transition-colors">Community Forum</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 className="font-semibold mb-4 text-slate-200">Legal</h4>
                        <ul className="space-y-2 text-sm text-slate-400">
                            <li><a href="#" className="hover:text-[#4CAF50] transition-colors">Privacy Policy</a></li>
                            <li><a href="#" className="hover:text-[#4CAF50] transition-colors">Terms of Service</a></li>
                            <li><a href="#" className="hover:text-[#4CAF50] transition-colors">Medical Disclaimer</a></li>
                        </ul>
                    </div>
                </div>
                <div className="text-center text-slate-500 text-xs border-t border-white/5 pt-8">
                    &copy; {new Date().getFullYear()} FitCommunity. All rights reserved. Designed for Health.
                </div>
            </footer>
            <AIDoctor />
        </div>
    );
}
