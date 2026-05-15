import React, { useState } from 'react';
import ThreeBackground from '../Components/ThreeBackground';
import AIDoctor from '../Components/AIDoctor';
import { motion } from 'framer-motion';
import { Activity, Search, Heart, Moon, Flame, Sun, ArrowRight, Video, Stethoscope, Dumbbell, Coffee, Bell, Menu, X, Plus, Clock, FileText, CheckCircle, Brain, Calendar, LogOut, ChevronRight } from 'lucide-react';
import {
  Chart as ChartJS,
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  LineController,
  BarController,
  Title,
  Tooltip,
  Legend,
  Filler
} from 'chart.js';
import { Bar, Line } from 'react-chartjs-2';

ChartJS.register(
  CategoryScale,
  LinearScale,
  PointElement,
  LineElement,
  BarElement,
  LineController,
  BarController,
  Title,
  Tooltip,
  Legend,
  Filler
);

export default function Dashboard({ user, healthData }) {
    const [sidebarOpen, setSidebarOpen] = useState(true);
    const [darkMode, setDarkMode] = useState(true);

    const themeColors = {
        bg: darkMode ? 'bg-[#0f172a]' : 'bg-slate-50',
        text: darkMode ? 'text-slate-100' : 'text-slate-900',
        cardBg: darkMode ? 'bg-[#1e293b]/60' : 'bg-white/80',
        sidebarBg: darkMode ? 'bg-[#1e293b]/80' : 'bg-white/90',
        borderColor: darkMode ? 'border-slate-700/50' : 'border-slate-200',
        mutedText: darkMode ? 'text-slate-400' : 'text-slate-500',
        inputBg: darkMode ? 'bg-[#0f172a]' : 'bg-slate-50',
    };

    const chartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'top',
                labels: { color: darkMode ? '#94a3b8' : '#64748b' }
            },
            title: {
                display: false,
            },
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { color: darkMode ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)' },
                ticks: { color: darkMode ? '#94a3b8' : '#64748b' }
            },
            x: {
                grid: { display: false },
                ticks: { color: darkMode ? '#94a3b8' : '#64748b' }
            }
        }
    };

    const stepsChartData = {
        labels: healthData?.labels || ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
        datasets: [
            {
                type: 'bar',
                label: 'Steps',
                data: healthData?.stepsData || [4000, 5500, 8000, 6000, 7500, 10000, 9500],
                backgroundColor: 'rgba(76, 175, 80, 0.8)',
                borderRadius: 6,
                yAxisID: 'y',
            },
            {
                type: 'line',
                label: 'Calories (kcal)',
                data: healthData?.caloriesData || [1500, 1800, 2100, 1900, 2200, 2500, 2400],
                borderColor: '#ef4444',
                backgroundColor: 'rgba(239, 68, 68, 0.1)',
                borderWidth: 3,
                tension: 0.4,
                fill: true,
                yAxisID: 'y1',
            }
        ],
    };

    const enhancedChartOptions = {
        ...chartOptions,
        scales: {
            y: {
                type: 'linear',
                display: true,
                position: 'left',
                grid: { color: darkMode ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)' },
                ticks: { color: darkMode ? '#94a3b8' : '#64748b' }
            },
            y1: {
                type: 'linear',
                display: true,
                position: 'right',
                grid: { drawOnChartArea: false },
                ticks: { color: darkMode ? '#94a3b8' : '#64748b' }
            },
            x: {
                grid: { display: false },
                ticks: { color: darkMode ? '#94a3b8' : '#64748b' }
            }
        }
    };

    const stats = healthData?.stats || { totalPosts: 0, totalRecords: 0, totalAppointments: 0, totalMessages: 0 };
    const today = healthData?.todayRecord || {};

    return (
        <div className={`flex h-screen ${themeColors.bg} ${themeColors.text} overflow-hidden font-sans transition-colors duration-300`}>
            {/* 3D Background - muted for dashboard */}
            <div className="absolute inset-0 opacity-30 pointer-events-none">
                <ThreeBackground />
            </div>

            {/* Sidebar */}
            <motion.aside 
                initial={false}
                animate={{ width: sidebarOpen ? 280 : 80 }}
                className={`relative z-20 h-full ${themeColors.sidebarBg} backdrop-blur-xl border-r ${themeColors.borderColor} flex flex-col transition-all duration-300`}
            >
                <div className={`p-6 flex items-center gap-4 border-b ${themeColors.borderColor}`}>
                    <div className="w-10 h-10 rounded-xl bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] flex items-center justify-center font-bold shadow-lg flex-shrink-0 text-white">
                        F
                    </div>
                    {sidebarOpen && <span className="text-xl font-bold tracking-tight whitespace-nowrap">FitCommunity</span>}
                </div>

                <nav className="flex-1 overflow-y-auto py-6 px-4 space-y-2">
                    <NavItem href="/dashboard" icon={<Activity />} label="Overview" active={true} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/health/history" icon={<Heart />} label="Health Metrics" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/workouts" icon={<Dumbbell />} label="Exercise Library" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/recipes" icon={<Coffee />} label="Diet & Recipes" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/meditation" icon={<Moon />} label="Meditation Hub" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/community" icon={<Activity />} label="Community Forums" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/blogs" icon={<Search />} label="Health Blogs" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/appointments" icon={<Bell />} label="Appointments" active={false} open={sidebarOpen} darkMode={darkMode} />
                    <NavItem href="/reports/analysis" icon={<Search />} label="Report Analysis" active={false} open={sidebarOpen} darkMode={darkMode} />
                </nav>

                <div className={`p-4 border-t ${themeColors.borderColor}`}>
                    <form method="POST" action="/logout">
                        <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')} />
                        <button type="submit" className={`w-full flex items-center justify-center gap-2 p-3 rounded-xl transition-colors ${darkMode ? 'text-slate-400 hover:bg-slate-800/50 hover:text-white hover:border hover:border-red-500/30' : 'text-slate-500 hover:bg-red-50 hover:text-red-600'}`}>
                            <LogOut size={20} className="rotate-180" />
                            {sidebarOpen && <span>Logout</span>}
                        </button>
                    </form>
                </div>
            </motion.aside>

            {/* Main Content */}
            <main className="flex-1 flex flex-col h-full relative z-10 overflow-hidden">
                {/* Header */}
                <header className={`h-20 ${themeColors.sidebarBg} backdrop-blur-md border-b ${themeColors.borderColor} flex items-center justify-between px-8 transition-colors duration-300`}>
                    <div className="flex items-center gap-4">
                        <button onClick={() => setSidebarOpen(!sidebarOpen)} className={`p-2 ${themeColors.mutedText} hover:${themeColors.text} rounded-lg transition-colors`}>
                            <Menu size={24} />
                        </button>
                        <h1 className="text-2xl font-bold hidden sm:block">Welcome back, {user?.name || 'User'}! 👋</h1>
                    </div>

                    <div className="flex items-center gap-6">
                        <button onClick={() => setDarkMode(!darkMode)} className={`p-2 ${themeColors.mutedText} hover:${themeColors.text} rounded-full transition-colors`}>
                            {darkMode ? <Sun size={20} className="text-yellow-400" /> : <Moon size={20} className="text-blue-500" />}
                        </button>
                        <div className="relative hidden md:block">
                            <Search className={`absolute left-3 top-1/2 -translate-y-1/2 ${themeColors.mutedText}`} size={18} />
                            <input 
                                type="text" 
                                placeholder="Search community..." 
                                className={`${themeColors.inputBg} border ${themeColors.borderColor} rounded-full py-2 pl-10 pr-4 text-sm focus:outline-none focus:border-[#4CAF50] transition-colors w-64 ${themeColors.text}`}
                            />
                        </div>
                        <button className={`relative p-2 ${themeColors.mutedText} hover:${themeColors.text} transition-colors`}>
                            <Bell size={24} />
                        </button>
                        <a href="/profile" className="w-10 h-10 rounded-full bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] p-0.5 cursor-pointer hover:shadow-lg transition-shadow">
                            <img src={user?.avatar ? `/storage/${user.avatar}` : `https://ui-avatars.com/api/?name=${user?.name || 'User'}&background=random`} alt="Avatar" className="w-full h-full rounded-full border-2 border-white" />
                        </a>
                    </div>
                </header>

                {/* Dashboard Content */}
                <div className="flex-1 overflow-y-auto p-8">
                    <div className="max-w-6xl mx-auto space-y-8">
                        {/* Stats Grid */}
                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <StatCard title="Today's Steps" value={today.steps || 0} subtitle="Goal: 10k" icon={<Activity className="text-green-400" />} trend="Daily" />
                            <StatCard title="Calories Burned" value={today.calories_burned || 0} subtitle="kcal" icon={<Flame className="text-orange-400" />} trend="Daily" />
                            <StatCard title="Community Posts" value={stats.totalPosts} subtitle="Total" icon={<Heart className="text-red-400" />} trend="All time" />
                            <StatCard title="Sleep Logged" value={`${today.sleep_hours || 0}h`} subtitle="Tonight" icon={<Moon className="text-blue-400" />} trend="Daily" />
                        </div>
                        {/* Wellness Pulse */}
                        <motion.div className={`${themeColors.cardBg} backdrop-blur-md border ${themeColors.borderColor} rounded-3xl p-6 shadow-lg mb-8 flex flex-col md:flex-row items-center justify-between gap-6`}>
                            <div className="flex items-center gap-4">
                                <div className="w-16 h-16 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white relative">
                                    <Heart className="animate-pulse" size={32} />
                                    <div className="absolute inset-0 bg-pink-500/30 rounded-full animate-ping"></div>
                                </div>
                                <div>
                                    <h3 className="text-xl font-bold">Community Wellness Pulse</h3>
                                    <p className={`text-sm ${themeColors.mutedText}`}>1,245 members are currently active and crushing their goals today!</p>
                                </div>
                            </div>
                            <div className="flex gap-3">
                                <div className="flex -space-x-4">
                                    <img className="w-10 h-10 rounded-full border-2 border-[#1e293b]" src="https://i.pravatar.cc/100?img=1" alt="Member" />
                                    <img className="w-10 h-10 rounded-full border-2 border-[#1e293b]" src="https://i.pravatar.cc/100?img=2" alt="Member" />
                                    <img className="w-10 h-10 rounded-full border-2 border-[#1e293b]" src="https://i.pravatar.cc/100?img=3" alt="Member" />
                                    <div className="w-10 h-10 rounded-full border-2 border-[#1e293b] bg-slate-700 flex items-center justify-center text-xs font-bold">+99</div>
                                </div>
                                <button className="bg-white/10 hover:bg-white/20 px-4 py-2 rounded-xl transition text-sm font-medium border border-white/10">Say Hi 👋</button>
                            </div>
                        </motion.div>

                        {/* Wellness Hub Section */}
                        <div className="mb-8">
                            <div className="flex items-center justify-between mb-6">
                                <div>
                                    <h2 className="text-xl font-bold mb-1">Wellness Hub</h2>
                                    <p className={`text-sm ${themeColors.mutedText}`}>Access specialized tools and connect with the community.</p>
                                </div>
                            </div>
                            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                                <HubCard 
                                    title="Fitness Guide" 
                                    desc="Personalized workout routines" 
                                    icon={<Activity className="text-blue-500" size={32} />} 
                                    onClick={() => window.dispatchEvent(new CustomEvent('open-ai-chat', { detail: 'Please provide a beginner friendly workout routine.' }))}
                                    darkMode={darkMode}
                                />
                                <HubCard 
                                    title="Diet & Recipe" 
                                    desc="Healthy meal plans" 
                                    icon={<Coffee className="text-yellow-500" size={32} />} 
                                    onClick={() => window.dispatchEvent(new CustomEvent('open-ai-chat', { detail: 'Can you give me a simple healthy diet plan?' }))}
                                    darkMode={darkMode}
                                />
                                <HubCard 
                                    title="Meditation" 
                                    desc="Guided mindfulness" 
                                    icon={<Moon className="text-indigo-400" size={32} />} 
                                    onClick={() => window.dispatchEvent(new CustomEvent('open-ai-chat', { detail: 'Please provide a 5-minute guided meditation script.' }))}
                                    darkMode={darkMode}
                                />
                                <HubCard 
                                    title="Medicine Info" 
                                    desc="Basic medical guidance" 
                                    icon={<Heart className="text-red-500" size={32} />} 
                                    onClick={() => window.dispatchEvent(new CustomEvent('open-ai-chat', { detail: 'I have a mild headache, what basic precautions should I take?' }))}
                                    darkMode={darkMode}
                                />
                            </div>
                        </div>

                        <div className="grid grid-cols-1 lg:grid-cols-3 gap-8 pb-12">
                            {/* Chart */}
                            <div className="lg:col-span-2">
                                <motion.div className={`${themeColors.cardBg} backdrop-blur-md border ${themeColors.borderColor} rounded-3xl p-6 shadow-lg h-[400px] flex flex-col transition-colors`}>
                                    <div className="flex justify-between items-center mb-6">
                                        <h3 className="text-lg font-bold">Activity Overview</h3>
                                        <select className={`${themeColors.inputBg} border ${themeColors.borderColor} ${themeColors.text} text-sm rounded-lg focus:ring-[#4CAF50] focus:border-[#4CAF50] p-2`}>
                                            <option>This Week</option>
                                            <option>Last Week</option>
                                            <option>This Month</option>
                                        </select>
                                    </div>
                                    <div className="flex-1 relative mt-4">
                                        <Bar data={stepsChartData} options={enhancedChartOptions} />
                                    </div>
                                </motion.div>
                            </div>

                            {/* Quick Action / Form */}
                            <div>
                                <motion.div className={`${themeColors.cardBg} backdrop-blur-md border ${themeColors.borderColor} rounded-3xl p-6 shadow-lg transition-colors`}>
                                    <h3 className="text-lg font-bold mb-4">Quick Log Today</h3>
                                    <form action="/dashboard/health" method="POST" className="flex-1 space-y-4">
                                        <input type="hidden" name="_token" value={document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')} />
                                    
                                    <div className="grid grid-cols-2 gap-2">
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Steps</label>
                                            <input type="number" name="steps" defaultValue={today.steps || ''} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Calories Burned</label>
                                            <input type="number" name="calories_burned" defaultValue={today.calories_burned || ''} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-2 gap-2">
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Height (cm)</label>
                                            <input type="number" step="0.1" name="height" id="height_input" defaultValue={today.height || ''} onInput={(e) => {
                                                const h = e.target.value;
                                                const w = document.getElementById('weight_input').value;
                                                if (h && w) {
                                                    document.getElementById('bmi_input').value = (w / ((h/100) * (h/100))).toFixed(1);
                                                }
                                            }} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Weight (kg)</label>
                                            <input type="number" step="0.1" name="weight" id="weight_input" defaultValue={today.weight || ''} onInput={(e) => {
                                                const w = e.target.value;
                                                const h = document.getElementById('height_input').value;
                                                if (h && w) {
                                                    document.getElementById('bmi_input').value = (w / ((h/100) * (h/100))).toFixed(1);
                                                }
                                            }} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-2 gap-2">
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>BMI (Auto Calc)</label>
                                            <input type="number" step="0.1" name="bmi" id="bmi_input" defaultValue={today.bmi || ''} readOnly className={`w-full bg-slate-100 dark:bg-slate-800 border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] cursor-not-allowed`} />
                                        </div>
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Blood Sugar</label>
                                            <input type="number" step="1" name="blood_sugar" defaultValue={today.blood_sugar || ''} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-2 gap-2 mt-2">
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Sleep (hrs)</label>
                                            <input type="number" step="0.1" name="sleep_hours" defaultValue={today.sleep_hours || ''} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Water (L)</label>
                                            <input type="number" step="0.1" name="water_intake" defaultValue={today.water_intake || ''} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-[#4CAF50] focus:ring-1 focus:ring-[#4CAF50]`} />
                                        </div>
                                    </div>
                                    <div className="grid grid-cols-2 gap-2 mt-2">
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Blood Pressure</label>
                                            <input type="text" name="blood_pressure" defaultValue={today.blood_pressure || ''} placeholder="120/80" className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-red-500 focus:ring-1 focus:ring-red-500`} />
                                        </div>
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Mindfulness (mins)</label>
                                            <input type="number" step="1" name="mindfulness_minutes" defaultValue={today.mindfulness_minutes || ''} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-purple-500 focus:ring-1 focus:ring-purple-500`} />
                                        </div>
                                    </div>
                                        <div className="space-y-1">
                                            <label className={`text-xs ${themeColors.mutedText}`}>Mood Today</label>
                                            <select name="mood" defaultValue={today.mood || 'Good'} className={`w-full ${themeColors.inputBg} border ${themeColors.borderColor} rounded-xl px-3 py-2 text-sm focus:outline-none focus:border-purple-500`}>
                                                <option value="Excellent">😁 Excellent</option>
                                                <option value="Good">🙂 Good</option>
                                                <option value="Neutral">😐 Neutral</option>
                                                <option value="Stressed">😫 Stressed</option>
                                                <option value="Low">😢 Low</option>
                                            </select>
                                        </div>
                                    </div>

                                    <button type="submit" className="w-full mt-6 py-3 rounded-xl bg-gradient-to-r from-[#4CAF50] to-[#2196F3] text-sm font-medium hover:opacity-90 transition-opacity text-white">
                                        Save Metrics
                                    </button>
                                </form>
                                </motion.div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

            <AIDoctor />
        </div>
    );
}

function NavItem({ href = '#', icon, label, active, open, darkMode = true }) {
    return (
        <a href={href} className={`flex items-center gap-3 p-3 rounded-xl transition-all ${active ? 'bg-gradient-to-r from-[#4CAF50]/20 to-[#2196F3]/20 text-white border border-[#4CAF50]/30' : (darkMode ? 'text-slate-400 hover:bg-slate-800/50 hover:text-slate-200' : 'text-slate-500 hover:bg-slate-200/50 hover:text-slate-800')} ${open ? '' : 'justify-center'}`}>
            <div className={`${active ? 'text-[#4CAF50]' : ''}`}>
                {icon}
            </div>
            {open && <span className="font-medium whitespace-nowrap">{label}</span>}
        </a>
    );
}

function StatCard({ title, value, subtitle, icon, trend, darkMode = true }) {
    return (
        <motion.div 
            whileHover={{ y: -5 }}
            className={`${darkMode ? 'bg-[#1e293b]/60 border-slate-700/50' : 'bg-white/80 border-slate-200'} backdrop-blur-md border rounded-3xl p-6 shadow-lg flex flex-col justify-between transition-colors`}
        >
            <div className="flex justify-between items-start mb-4">
                <div className={`p-3 ${darkMode ? 'bg-[#0f172a] border-slate-700/50' : 'bg-slate-50 border-slate-200'} rounded-2xl border`}>
                    {icon}
                </div>
                <span className={`text-xs font-medium px-2 py-1 ${darkMode ? 'bg-[#0f172a] border-slate-700 text-slate-300' : 'bg-slate-50 border-slate-200 text-slate-600'} rounded-lg border`}>
                    {trend}
                </span>
            </div>
            <div>
                <h4 className={`${darkMode ? 'text-slate-400' : 'text-slate-500'} text-sm font-medium mb-1`}>{title}</h4>
                <div className="flex items-baseline gap-2">
                    <span className="text-3xl font-bold">{value}</span>
                    <span className={`text-sm ${darkMode ? 'text-slate-500' : 'text-slate-400'}`}>{subtitle}</span>
                </div>
            </div>
        </motion.div>
    );
}

function HubCard({ title, desc, icon, onClick, darkMode = true }) {
    return (
        <motion.div 
            whileHover={{ y: -5 }}
            onClick={onClick}
            className={`${darkMode ? 'bg-[#1e293b]/60 border-slate-700/50 hover:shadow-[#4CAF50]/10 text-slate-200' : 'bg-white/80 border-slate-200 hover:shadow-[#4CAF50]/20 text-slate-800'} backdrop-blur-md border rounded-3xl p-6 shadow-sm hover:shadow-xl transition-all cursor-pointer flex flex-col items-center text-center group`}
        >
            <div className="mb-4 transform group-hover:scale-110 transition-transform">
                {icon}
            </div>
            <h4 className="text-lg font-bold mb-2">{title}</h4>
            <p className={`${darkMode ? 'text-slate-400' : 'text-slate-500'} text-sm leading-relaxed`}>{desc}</p>
        </motion.div>
    );
}
