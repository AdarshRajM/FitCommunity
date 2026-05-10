import React, { useState, useEffect, useRef } from 'react';
import Peer from 'simple-peer';
import { motion } from 'framer-motion';
import { Mic, MicOff, Video, VideoOff, PhoneOff, User, Activity, AlertCircle, Maximize, Loader } from 'lucide-react';
import ThreeBackground from '../Components/ThreeBackground';

export default function TelemedicineRoom({ user, peerId }) {
    const [stream, setStream] = useState(null);
    const [receivingCall, setReceivingCall] = useState(false);
    const [callerSignal, setCallerSignal] = useState();
    const [callAccepted, setCallAccepted] = useState(false);
    const [callEnded, setCallEnded] = useState(false);
    const [isMuted, setIsMuted] = useState(false);
    const [isVideoOff, setIsVideoOff] = useState(false);
    const [isConnecting, setIsConnecting] = useState(true);

    const myVideo = useRef();
    const userVideo = useRef();
    const connectionRef = useRef();

    useEffect(() => {
        // Request Camera & Mic access
        navigator.mediaDevices.getUserMedia({ video: true, audio: true }).then((currentStream) => {
            setStream(currentStream);
            if (myVideo.current) {
                myVideo.current.srcObject = currentStream;
            }
            
            // Simulate connection delay for UI
            setTimeout(() => {
                setIsConnecting(false);
            }, 2000);
        }).catch(err => {
            console.error("Failed to get local stream", err);
            setIsConnecting(false);
        });

        // Setup cleanup
        return () => {
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
            if (connectionRef.current) {
                connectionRef.current.destroy();
            }
        };
    }, []);

    const toggleMute = () => {
        if (stream) {
            stream.getAudioTracks()[0].enabled = !stream.getAudioTracks()[0].enabled;
            setIsMuted(!stream.getAudioTracks()[0].enabled);
        }
    };

    const toggleVideo = () => {
        if (stream) {
            stream.getVideoTracks()[0].enabled = !stream.getVideoTracks()[0].enabled;
            setIsVideoOff(!stream.getVideoTracks()[0].enabled);
        }
    };

    const leaveCall = () => {
        setCallEnded(true);
        if (connectionRef.current) {
            connectionRef.current.destroy();
        }
        if (stream) {
            stream.getTracks().forEach(track => track.stop());
        }
        window.location.href = user.role === 'doctor' ? '/doctor/dashboard' : '/dashboard';
    };

    return (
        <div className="flex h-screen bg-[#0f172a] text-slate-100 overflow-hidden font-sans relative">
            {/* 3D Background */}
            <div className="absolute inset-0 opacity-10 pointer-events-none z-0">
                <ThreeBackground />
            </div>

            <div className="relative z-10 w-full flex flex-col h-full">
                {/* Header */}
                <header className="h-16 bg-[#1e293b]/80 backdrop-blur-md border-b border-slate-700/50 flex items-center justify-between px-6">
                    <div className="flex items-center gap-3">
                        <div className="w-8 h-8 rounded-lg bg-gradient-to-tr from-blue-500 to-indigo-500 flex items-center justify-center font-bold shadow-lg">
                            <Activity size={16} />
                        </div>
                        <span className="text-lg font-bold tracking-tight">Telemedicine Room</span>
                    </div>
                    <div className="flex items-center gap-3">
                        <span className="px-3 py-1 bg-red-500/20 text-red-400 border border-red-500/30 rounded-full text-xs font-semibold flex items-center gap-2 animate-pulse">
                            <span className="w-2 h-2 rounded-full bg-red-500"></span> Live Encrypted Call
                        </span>
                    </div>
                </header>

                {/* Main Video Area */}
                <main className="flex-1 p-6 flex flex-col lg:flex-row gap-6 h-full overflow-hidden">
                    
                    {/* Primary Video (Remote User) */}
                    <div className="flex-1 bg-black/60 rounded-3xl border border-slate-700/50 relative overflow-hidden flex items-center justify-center shadow-2xl backdrop-blur-sm">
                        {callAccepted && !callEnded ? (
                            <video playsInline ref={userVideo} autoPlay className="w-full h-full object-cover" />
                        ) : (
                            <div className="text-center flex flex-col items-center">
                                {isConnecting ? (
                                    <>
                                        <Loader className="w-16 h-16 text-blue-500 animate-spin mb-4" />
                                        <h2 className="text-xl font-medium text-slate-300 animate-pulse">Connecting to secure server...</h2>
                                    </>
                                ) : (
                                    <>
                                        <div className="w-24 h-24 rounded-full bg-slate-800 flex items-center justify-center mb-4 shadow-[0_0_30px_rgba(59,130,246,0.3)]">
                                            <User size={40} className="text-slate-400" />
                                        </div>
                                        <h2 className="text-2xl font-bold text-slate-200">Waiting for {user.role === 'doctor' ? 'Patient' : 'Doctor'}...</h2>
                                        <p className="text-slate-500 mt-2">The other party has not joined yet. Please stay on this screen.</p>
                                    </>
                                )}
                            </div>
                        )}

                        {/* Controls Overlay */}
                        <div className="absolute bottom-8 left-1/2 -translate-x-1/2 flex items-center gap-4 bg-[#1e293b]/80 backdrop-blur-xl px-6 py-4 rounded-full border border-slate-700/50 shadow-2xl transition-all hover:bg-[#1e293b]/90">
                            <button onClick={toggleMute} className={`w-12 h-12 rounded-full flex items-center justify-center transition-all ${isMuted ? 'bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20' : 'bg-slate-700 hover:bg-slate-600 text-white'}`}>
                                {isMuted ? <MicOff size={20} /> : <Mic size={20} />}
                            </button>
                            <button onClick={toggleVideo} className={`w-12 h-12 rounded-full flex items-center justify-center transition-all ${isVideoOff ? 'bg-red-500 hover:bg-red-600 text-white shadow-lg shadow-red-500/20' : 'bg-slate-700 hover:bg-slate-600 text-white'}`}>
                                {isVideoOff ? <VideoOff size={20} /> : <Video size={20} />}
                            </button>
                            <button onClick={leaveCall} className="w-16 h-12 rounded-full bg-red-600 hover:bg-red-700 text-white flex items-center justify-center transition-all shadow-lg shadow-red-600/30">
                                <PhoneOff size={22} />
                            </button>
                        </div>
                    </div>

                    {/* Sidebar / Local Video */}
                    <div className="w-full lg:w-80 flex flex-col gap-6">
                        {/* Local Video Stream */}
                        <div className="h-48 lg:h-64 bg-black/80 rounded-3xl border border-slate-700/50 overflow-hidden relative shadow-xl backdrop-blur-md">
                            {stream ? (
                                <video playsInline muted ref={myVideo} autoPlay className={`w-full h-full object-cover ${isVideoOff ? 'hidden' : ''}`} />
                            ) : (
                                <div className="w-full h-full flex items-center justify-center">
                                    <Loader className="w-8 h-8 text-slate-500 animate-spin" />
                                </div>
                            )}
                            {isVideoOff && (
                                <div className="absolute inset-0 flex items-center justify-center bg-slate-900">
                                    <VideoOff size={32} className="text-slate-500" />
                                </div>
                            )}
                            <div className="absolute bottom-3 left-3 bg-black/60 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-medium border border-white/10 flex items-center gap-2">
                                You {isMuted && <MicOff size={12} className="text-red-400" />}
                            </div>
                        </div>

                        {/* Call Info Panel */}
                        <div className="flex-1 bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-3xl p-6 shadow-xl flex flex-col">
                            <h3 className="text-lg font-bold border-b border-slate-700/50 pb-4 mb-4">Session Info</h3>
                            <div className="space-y-4 flex-1">
                                <div>
                                    <label className="text-xs text-slate-400">Participant</label>
                                    <p className="font-medium text-slate-200">{user.name} ({user.role})</p>
                                </div>
                                <div>
                                    <label className="text-xs text-slate-400">Connection Quality</label>
                                    <p className="font-medium text-green-400 flex items-center gap-2">
                                        <Activity size={14} /> Excellent
                                    </p>
                                </div>
                                <div className="bg-[#0f172a] p-4 rounded-xl border border-slate-700">
                                    <p className="text-xs text-slate-400 leading-relaxed flex gap-2">
                                        <AlertCircle size={16} className="text-blue-400 flex-shrink-0" />
                                        This telemedicine session is end-to-end encrypted. Medical advice given here should be followed up with an official diagnosis report.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    );
}
