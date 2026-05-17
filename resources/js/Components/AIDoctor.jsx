import React, { useState, useRef, useEffect } from 'react';
import { MessageSquare, X, Send, Bot, User as UserIcon, Mic, MicOff, Image as ImageIcon, Activity, Coffee, AlertTriangle, ChevronLeft, Loader, Stethoscope, Video, BellRing, CheckCircle2, Sun, Moon } from 'lucide-react';
import axios from 'axios';

export default function AIDoctor() {
    const [isOpen, setIsOpen] = useState(false);
    const [mode, setMode] = useState('menu'); // 'menu', 'chat', 'symptoms', 'diet', 'doctors'
    const [messages, setMessages] = useState([]);
    const [input, setInput] = useState('');
    const [isTyping, setIsTyping] = useState(false);
    const [isRecording, setIsRecording] = useState(false);
    const [selectedImage, setSelectedImage] = useState(null);
    const [doctorsList, setDoctorsList] = useState([]);
    const [isLoadingDoctors, setIsLoadingDoctors] = useState(false);
    const [alertStatus, setAlertStatus] = useState({}); // Track alert status by doctor id
    const [isDarkMode, setIsDarkMode] = useState(true); // Light/Dark Mode state

    const messagesEndRef = useRef(null);
    const fileInputRef = useRef(null);

    // Speech Recognition setup
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
    const recognition = SpeechRecognition ? new SpeechRecognition() : null;

    useEffect(() => {
        if (recognition) {
            recognition.continuous = false;
            recognition.interimResults = false;
            recognition.lang = 'en-US';

            recognition.onresult = (event) => {
                const transcript = event.results[0][0].transcript;
                setInput(prev => prev + " " + transcript);
                setIsRecording(false);
            };

            recognition.onerror = (event) => {
                console.error("Speech recognition error", event.error);
                setIsRecording(false);
            };

            recognition.onend = () => {
                setIsRecording(false);
            };
        }
    }, []);

    useEffect(() => {
        const handleOpenChat = (e) => {
            setIsOpen(true);
            setMode('chat');
            const userMsg = e.detail;
            
            setMessages([{ id: Date.now(), text: userMsg, sender: 'user' }]);
            setIsTyping(true);

            const formData = new FormData();
            formData.append('message', userMsg);
            formData.append('mode', 'chat');

            axios.post('/api/ai/chat', formData)
                .then(res => {
                    setMessages(prev => [...prev, { id: Date.now() + 1, text: res.data.reply, sender: 'bot' }]);
                })
                .catch(err => {
                    console.error(err);
                    setMessages(prev => [...prev, { id: Date.now() + 1, text: "I am having trouble connecting right now.", sender: 'bot' }]);
                })
                .finally(() => setIsTyping(false));
        };

        window.addEventListener('open-ai-chat', handleOpenChat);
        return () => window.removeEventListener('open-ai-chat', handleOpenChat);
    }, []);
    const toggleRecording = () => {
        if (!recognition) {
            alert("Your browser does not support voice input.");
            return;
        }

        if (isRecording) {
            recognition.stop();
        } else {
            recognition.start();
            setIsRecording(true);
        }
    };

    const scrollToBottom = () => {
        messagesEndRef.current?.scrollIntoView({ behavior: "smooth" });
    };

    useEffect(() => {
        if (mode !== 'doctors') {
            scrollToBottom();
        }
    }, [messages, isTyping, mode]);

    const fetchDoctors = async () => {
        setIsLoadingDoctors(true);
        try {
            const res = await axios.get('/api/doctors/directory');
            setDoctorsList(res.data);
        } catch (error) {
            console.error("Failed to fetch doctors", error);
        } finally {
            setIsLoadingDoctors(false);
        }
    };

    const sendEmergencyAlert = async (docId) => {
        setAlertStatus(prev => ({ ...prev, [docId]: 'sending' }));
        try {
            const res = await axios.post(`/api/doctors/alert/${docId}`);
            setAlertStatus(prev => ({ ...prev, [docId]: 'sent' }));
            setTimeout(() => {
                setAlertStatus(prev => ({ ...prev, [docId]: null }));
            }, 3000);
        } catch (error) {
            setAlertStatus(prev => ({ ...prev, [docId]: 'error' }));
        }
    };

    const startMode = (selectedMode, initialMessage) => {
        setMode(selectedMode);
        if (selectedMode === 'doctors') {
            fetchDoctors();
            return;
        }
        setMessages([{ id: Date.now(), text: initialMessage, sender: 'bot' }]);
    };

    const handleImageSelect = (e) => {
        if (e.target.files && e.target.files[0]) {
            setSelectedImage(e.target.files[0]);
        }
    };

    const handleSend = async () => {
        if (!input.trim() && !selectedImage) return;

        const userText = input;
        const imageFile = selectedImage;

        const newUserMsg = {
            id: Date.now(),
            text: userText,
            sender: 'user',
            imagePreview: imageFile ? URL.createObjectURL(imageFile) : null
        };

        setMessages(prev => [...prev, newUserMsg]);
        setInput('');
        setSelectedImage(null);
        setIsTyping(true);

        try {
            const formData = new FormData();
            formData.append('message', userText || "Please analyze this image.");
            formData.append('mode', mode);
            if (imageFile) {
                formData.append('image', imageFile);
            }

            const response = await axios.post('/api/ai/chat', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });

            setMessages(prev => [...prev, { id: Date.now() + 1, text: response.data.reply, sender: 'bot' }]);
        } catch (error) {
            console.error("AI API Error:", error);
            setMessages(prev => [...prev, { id: Date.now() + 1, text: "I'm sorry, I'm having trouble connecting to my servers right now.", sender: 'bot' }]);
        } finally {
            setIsTyping(false);
        }
    };

    return (
        <div className="fixed bottom-6 right-6 z-50">
            {/* Chat Window */}
            <div
                className={`transition-all duration-300 transform origin-bottom-right ${isOpen ? 'scale-100 opacity-100 mb-4' : 'scale-0 opacity-0 h-0 w-0 overflow-hidden'}`}
            >
                <div className={`w-80 sm:w-[450px] backdrop-blur-xl border rounded-2xl shadow-2xl flex flex-col h-[600px] max-h-[85vh] ${isDarkMode ? 'bg-[#1e293b]/95 border-slate-700/50' : 'bg-white/95 border-gray-200'}`}>
                    {/* Header */}
                    <div className="bg-gradient-to-r from-[#4CAF50] to-[#2196F3] p-4 flex justify-between items-center text-white rounded-t-2xl">
                        <div className="flex items-center gap-3">
                            {mode !== 'menu' && (
                                <button onClick={() => setMode('menu')} className="p-1 hover:bg-white/20 rounded-full transition">
                                    <ChevronLeft size={20} />
                                </button>
                            )}
                            <div className="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center relative">
                                <Bot size={24} className="text-white" />
                                {isTyping && <span className="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full border-2 border-slate-800 animate-pulse"></span>}
                            </div>
                            <div>
                                <h3 className="font-semibold leading-tight">Fit AI Doctor</h3>
                                <span className="text-xs text-white/80 flex items-center gap-1">
                                    <span className="w-2 h-2 rounded-full bg-green-400 animate-pulse"></span> {mode === 'menu' ? 'Online' : mode.toUpperCase()}
                                </span>
                            </div>
                        </div>
                        <div className="flex items-center gap-2">
                            <button onClick={() => setIsDarkMode(!isDarkMode)} className="text-white/80 hover:text-white transition-colors p-1 hover:bg-white/10 rounded-full">
                                {isDarkMode ? <Sun size={18} /> : <Moon size={18} />}
                            </button>
                            <button onClick={() => setIsOpen(false)} className="text-white/80 hover:text-white transition-colors p-1 hover:bg-white/10 rounded-full">
                                <X size={20} />
                            </button>
                        </div>
                    </div>

                    {/* Content Area */}
                    <div className="flex-1 overflow-y-auto p-4 flex flex-col">
                        {mode === 'menu' ? (
                            <div className="space-y-4 h-full flex flex-col justify-center animate-in fade-in zoom-in duration-300">
                                <p className={`text-center mb-2 text-sm ${isDarkMode ? 'text-slate-300' : 'text-slate-500'}`}>How can I assist you today?</p>

                                <button onClick={() => startMode('symptoms', 'Hello! Please describe your symptoms or upload a photo of your concern/prescription.')} className="flex items-center gap-4 p-4 bg-[#0f172a] rounded-xl border border-slate-700 hover:border-[#4CAF50] hover:bg-slate-800 transition-all group">
                                    <div className="w-10 h-10 rounded-full bg-red-500/20 text-red-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <Activity size={20} />
                                    </div>
                                    <div className="text-left">
                                        <h4 className="font-semibold text-slate-200">Symptom Checker</h4>
                                        <p className="text-xs text-slate-400">Identify causes & upload medical images</p>
                                    </div>
                                </button>

                                <button onClick={() => startMode('diet', 'Hi! Provide your weight, age, and fitness goal, or upload a picture of your current meal.')} className="flex items-center gap-4 p-4 bg-[#0f172a] rounded-xl border border-slate-700 hover:border-[#4CAF50] hover:bg-slate-800 transition-all group">
                                    <div className="w-10 h-10 rounded-full bg-green-500/20 text-green-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <Coffee size={20} />
                                    </div>
                                    <div className="text-left">
                                        <h4 className="font-semibold text-slate-200">Diet Planner</h4>
                                        <p className="text-xs text-slate-400">Get personalized meal suggestions</p>
                                    </div>
                                </button>

                                <button onClick={() => startMode('chat', 'Hello! Ask me anything about health, wellness, or fitness.')} className="flex items-center gap-4 p-4 bg-[#0f172a] rounded-xl border border-slate-700 hover:border-[#4CAF50] hover:bg-slate-800 transition-all group">
                                    <div className="w-10 h-10 rounded-full bg-blue-500/20 text-blue-400 flex items-center justify-center group-hover:scale-110 transition-transform">
                                        <MessageSquare size={20} />
                                    </div>
                                    <div className="text-left">
                                        <h4 className="font-semibold text-slate-200">General Chat</h4>
                                        <p className="text-xs text-slate-400">Voice or text, I am here to listen.</p>
                                    </div>
                                </button>

                                <button onClick={() => startMode('doctors')} className="flex items-center gap-4 p-4 bg-indigo-500/10 rounded-xl border border-indigo-500/30 hover:bg-indigo-500/20 transition-all group mt-2">
                                    <div className="w-10 h-10 rounded-full bg-indigo-500 text-white flex items-center justify-center group-hover:animate-pulse">
                                        <Stethoscope size={20} />
                                    </div>
                                    <div className="text-left">
                                        <h4 className="font-semibold text-indigo-400">Talk to Real Doctor</h4>
                                        <p className="text-xs text-indigo-300/80">Connect or alert an offline doctor</p>
                                    </div>
                                </button>
                            </div>
                        ) : mode === 'doctors' ? (
                            <div className="space-y-4 animate-in fade-in duration-300">
                                <h3 className="text-slate-200 font-semibold mb-4 text-center">Available Medical Professionals</h3>
                                {isLoadingDoctors ? (
                                    <div className="flex justify-center p-8"><Loader className="animate-spin text-blue-400" /></div>
                                ) : (
                                    <div className="space-y-3">
                                        {doctorsList.map(doc => (
                                            <div key={doc.id} className="bg-[#0f172a] border border-slate-700 rounded-xl p-4 flex flex-col gap-3">
                                                <div className="flex justify-between items-start">
                                                    <div className="flex items-center gap-3">
                                                        <div className="w-10 h-10 rounded-full bg-slate-800 flex items-center justify-center">
                                                            <UserIcon size={20} className="text-slate-400" />
                                                        </div>
                                                        <div>
                                                            <h4 className="text-slate-200 font-semibold text-sm">{doc.name}</h4>
                                                            <p className="text-xs text-blue-400 font-medium">{doc.specialty}</p>
                                                        </div>
                                                    </div>
                                                    <div className="text-right">
                                                        {doc.isOnline ? (
                                                            <span className="text-xs text-green-400 flex items-center gap-1 justify-end"><span className="w-2 h-2 rounded-full bg-green-400"></span> Online</span>
                                                        ) : (
                                                            <span className="text-xs text-slate-500">Offline (seen {doc.lastSeen})</span>
                                                        )}
                                                    </div>
                                                </div>

                                                <div className="flex gap-2 mt-2">
                                                    {doc.isOnline ? (
                                                        <a href={`/telemedicine/room/${doc.id}`} className="flex-1 bg-green-500/20 hover:bg-green-500/30 text-green-400 border border-green-500/30 text-xs py-2 rounded-lg flex items-center justify-center gap-2 transition-colors">
                                                            <Video size={14} /> Call Now
                                                        </a>
                                                    ) : (
                                                        <button
                                                            onClick={() => sendEmergencyAlert(doc.id)}
                                                            disabled={alertStatus[doc.id] === 'sending' || alertStatus[doc.id] === 'sent'}
                                                            className={`flex-1 text-xs py-2 rounded-lg flex items-center justify-center gap-2 transition-colors ${alertStatus[doc.id] === 'sent' ? 'bg-green-500/20 text-green-400 border-green-500/30 border' : 'bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/30'}`}
                                                        >
                                                            {alertStatus[doc.id] === 'sending' ? <Loader size={14} className="animate-spin" /> :
                                                                alertStatus[doc.id] === 'sent' ? <CheckCircle2 size={14} /> :
                                                                    <BellRing size={14} />}
                                                            {alertStatus[doc.id] === 'sent' ? 'Alert Sent!' : 'Send Emergency Alert'}
                                                        </button>
                                                    )}
                                                </div>
                                            </div>
                                        ))}
                                        {doctorsList.length === 0 && <p className="text-center text-slate-500 text-sm">No doctors available right now.</p>}
                                    </div>
                                )}
                            </div>
                        ) : (
                            <div className="space-y-4">
                                {messages.map((msg) => (
                                    <div key={msg.id} className={`flex ${msg.sender === 'user' ? 'justify-end' : 'justify-start'}`}>
                                        <div className={`flex max-w-[85%] gap-2 ${msg.sender === 'user' ? 'flex-row-reverse' : 'flex-row'}`}>
                                            <div className={`w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center ${msg.sender === 'user' ? 'bg-[#4CAF50]' : 'bg-[#2196F3]'}`}>
                                                {msg.sender === 'user' ? <UserIcon size={16} className="text-white" /> : <Bot size={16} className="text-white" />}
                                            </div>
                                            <div className={`p-3 rounded-2xl text-sm shadow-sm whitespace-pre-line ${msg.sender === 'user' ? 'bg-[#4CAF50] text-white rounded-tr-sm' : (isDarkMode ? 'bg-slate-700 text-slate-100' : 'bg-gray-100 text-slate-800 border border-gray-200') + ' rounded-tl-sm'}`}>
                                                {msg.imagePreview && (
                                                    <img src={msg.imagePreview} alt="Uploaded content" className="w-full max-w-xs rounded-lg mb-2 border border-white/20" />
                                                )}
                                                {msg.text}
                                            </div>
                                        </div>
                                    </div>
                                ))}
                                {isTyping && (
                                    <div className="flex justify-start">
                                        <div className="flex max-w-[85%] gap-2 flex-row">
                                            <div className="w-8 h-8 rounded-full flex-shrink-0 flex items-center justify-center bg-[#2196F3]">
                                                <Bot size={16} className="text-white" />
                                            </div>
                                            <div className="p-4 rounded-2xl bg-slate-700 text-slate-100 rounded-tl-sm flex gap-1 items-center">
                                                <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce"></div>
                                                <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: '0.2s' }}></div>
                                                <div className="w-2 h-2 bg-slate-400 rounded-full animate-bounce" style={{ animationDelay: '0.4s' }}></div>
                                            </div>
                                        </div>
                                    </div>
                                )}
                                <div ref={messagesEndRef} />
                            </div>
                        )}
                    </div>

                    {/* Input Area (only visible in chat modes) */}
                    {mode !== 'menu' && mode !== 'doctors' && (
                        <div className={`p-3 rounded-b-2xl border-t flex flex-col gap-2 ${isDarkMode ? 'bg-[#0f172a] border-slate-700/50' : 'bg-slate-100 border-gray-200'}`}>
                            {selectedImage && (
                                <div className="flex items-center gap-2 p-2 bg-slate-800 rounded-lg border border-slate-700 text-xs text-slate-300">
                                    <span className="truncate flex-1">{selectedImage.name}</span>
                                    <button onClick={() => setSelectedImage(null)} className="text-red-400 hover:text-red-300"><X size={14} /></button>
                                </div>
                            )}
                            <div className={`flex items-center gap-2 rounded-full p-1 pr-2 border focus-within:ring-2 focus-within:ring-[#4CAF50] transition-all relative ${isDarkMode ? 'bg-slate-800 border-slate-700' : 'bg-white border-gray-300'}`}>
                                <input
                                    type="file"
                                    accept="image/*"
                                    className="hidden"
                                    ref={fileInputRef}
                                    onChange={handleImageSelect}
                                />
                                <button onClick={() => fileInputRef.current.click()} className="p-2 text-slate-400 hover:text-[#2196F3] transition-colors rounded-full hover:bg-slate-700">
                                    <ImageIcon size={20} />
                                </button>
                                <input
                                    type="text"
                                    value={input}
                                    onChange={(e) => setInput(e.target.value)}
                                    autoFocus
                                    onKeyPress={(e) => e.key === 'Enter' && handleSend()}
                                    placeholder={isRecording ? "Listening..." : "Type or speak your message..."}
                                    className={`flex-1 bg-transparent border-none text-sm focus:ring-0 px-2 ${isDarkMode ? 'text-slate-200' : 'text-slate-800'}`}
                                />
                                <button onClick={toggleRecording} className={`p-2 transition-colors rounded-full ${isRecording ? 'text-red-500 bg-red-500/10 animate-pulse' : 'text-slate-400 hover:text-red-400 hover:bg-slate-700'}`}>
                                    {isRecording ? <MicOff size={20} /> : <Mic size={20} />}
                                </button>
                                <button
                                    onClick={handleSend}
                                    disabled={(!input.trim() && !selectedImage) || isTyping}
                                    className={`p-2 rounded-full transition-all flex-shrink-0 ${input.trim() || selectedImage ? 'bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] text-white shadow-lg hover:opacity-90' : 'bg-slate-700 text-slate-500'}`}
                                >
                                    {isTyping ? <Loader className="animate-spin" size={18} /> : <Send size={18} className={(input.trim() || selectedImage) ? 'ml-0.5' : ''} />}
                                </button>
                            </div>
                        </div>
                    )}
                </div>
            </div>

            {/* Floating Toggle Button */}
            <button
                onClick={() => setIsOpen(!isOpen)}
                className={`w-16 h-16 rounded-full flex items-center justify-center shadow-2xl transition-transform duration-300 shadow-[#4CAF50]/40 float-right ${isOpen ? 'rotate-90 bg-slate-800 text-white border border-slate-700' : 'bg-gradient-to-tr from-[#4CAF50] to-[#2196F3] text-white hover:scale-110'}`}
            >
                {isOpen ? <X size={28} /> : <MessageSquare size={28} />}
            </button>
        </div>
    );
}
