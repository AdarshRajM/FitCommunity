import React, { useState } from 'react';
import { motion } from 'framer-motion';
import ThreeBackground from '../Components/ThreeBackground';
import { UploadCloud, FileText, ArrowLeft, Loader2, AlertCircle } from 'lucide-react';
import axios from 'axios';

export default function ReportAnalysis() {
    const [file, setFile] = useState(null);
    const [preview, setPreview] = useState('');
    const [isAnalyzing, setIsAnalyzing] = useState(false);
    const [analysisResult, setAnalysisResult] = useState('');
    const [error, setError] = useState('');

    const handleFileChange = (e) => {
        const selectedFile = e.target.files[0];
        if (selectedFile) {
            setFile(selectedFile);
            setPreview(URL.createObjectURL(selectedFile));
            setAnalysisResult('');
            setError('');
        }
    };

    const handleAnalyze = async () => {
        if (!file) return;

        setIsAnalyzing(true);
        setError('');
        
        try {
            const formData = new FormData();
            formData.append('message', "Analyze this medical report/image and summarize the key findings in simple terms.");
            formData.append('mode', 'report');
            formData.append('image', file);
            
            try {
                const response = await axios.post('/api/ai/chat', formData, {
                    headers: { 'Content-Type': 'multipart/form-data' }
                });
                
                setAnalysisResult(response.data.reply);
            } catch (err) {
                setError('Failed to analyze the report. Please try again.');
                console.error(err);
            } finally {
                setIsAnalyzing(false);
            }
        } catch (err) {
            setError('Error processing the file.');
            setIsAnalyzing(false);
        }
    };

    return (
        <div className="min-h-screen bg-[#0f172a] text-slate-100 font-sans relative overflow-x-hidden">
            <div className="absolute inset-0 opacity-20 pointer-events-none">
                <ThreeBackground />
            </div>

            <div className="relative z-10 max-w-4xl mx-auto px-6 py-12">
                <a href="/dashboard" className="inline-flex items-center gap-2 text-slate-400 hover:text-white mb-8 transition">
                    <ArrowLeft size={20} />
                    <span>Back to Dashboard</span>
                </a>

                <div className="mb-8">
                    <h1 className="text-4xl font-bold mb-4 bg-clip-text text-transparent bg-gradient-to-r from-[#4CAF50] to-[#2196F3]">
                        AI Report Analysis
                    </h1>
                    <p className="text-slate-400 text-lg">
                        Upload your blood tests, X-rays, or medical reports and our AI will summarize them for you in simple terms.
                    </p>
                </div>

                <div className="bg-[#1e293b]/60 backdrop-blur-md border border-slate-700/50 rounded-3xl p-8 shadow-xl">
                    
                    <div className="mb-6 bg-yellow-500/10 border border-yellow-500/30 rounded-xl p-4 flex gap-3 text-yellow-200">
                        <AlertCircle className="flex-shrink-0 text-yellow-400" />
                        <p className="text-sm">
                            <strong className="font-bold">Disclaimer:</strong> This AI analysis is for informational purposes only and does not constitute medical advice, diagnosis, or treatment. Always consult a qualified healthcare provider for medical decisions.
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <label className="flex flex-col items-center justify-center w-full h-64 border-2 border-slate-600 border-dashed rounded-2xl cursor-pointer hover:bg-slate-800/50 hover:border-[#4CAF50] transition group relative overflow-hidden">
                                {preview ? (
                                    file && file.type === 'application/pdf' ? (
                                        <div className="absolute inset-0 flex flex-col items-center justify-center p-5 text-center text-slate-200 bg-[#0f172a]/80">
                                            <div className="w-16 h-16 rounded-full bg-[#111827] flex items-center justify-center mb-4 border border-slate-700">
                                                <FileText size={32} className="text-[#4CAF50]" />
                                            </div>
                                            <p className="font-semibold text-slate-100">PDF Report Selected</p>
                                            <p className="text-sm text-slate-400 mt-2">{file.name}</p>
                                        </div>
                                    ) : (
                                        <img src={preview} alt="Preview" className="absolute inset-0 w-full h-full object-contain p-2" />
                                    )
                                ) : (
                                    <div className="flex flex-col items-center justify-center pt-5 pb-6">
                                        <UploadCloud className="w-12 h-12 text-slate-500 group-hover:text-[#4CAF50] mb-4 transition" />
                                        <p className="mb-2 text-sm text-slate-400 font-semibold">Click to upload report</p>
                                        <p className="text-xs text-slate-500">PNG, JPG or PDF (Max 5MB)</p>
                                    </div>
                                )}
                                <input type="file" className="hidden" accept="image/*,application/pdf" onChange={handleFileChange} />
                            </label>

                            <button 
                                onClick={handleAnalyze}
                                disabled={!file || isAnalyzing}
                                className={`w-full mt-6 py-4 rounded-xl font-bold text-white shadow-lg transition-all flex items-center justify-center gap-2 ${!file || isAnalyzing ? 'bg-slate-700 cursor-not-allowed opacity-70' : 'bg-gradient-to-r from-[#4CAF50] to-[#2196F3] hover:opacity-90 transform hover:-translate-y-1'}`}
                            >
                                {isAnalyzing ? (
                                    <><Loader2 className="animate-spin" size={20} /> Analyzing Report...</>
                                ) : (
                                    <><FileText size={20} /> Summarize Report</>
                                )}
                            </button>

                            {error && <p className="text-red-400 text-sm mt-4 text-center">{error}</p>}
                        </div>

                        <div className="bg-[#0f172a] rounded-2xl border border-slate-700/50 p-6 overflow-y-auto max-h-[500px]">
                            <h3 className="text-xl font-bold mb-4 text-slate-200">Analysis Results</h3>
                            
                            {analysisResult ? (
                                <div className="prose prose-invert prose-green max-w-none">
                                    {/* Render basic markdown/newlines from AI */}
                                    {analysisResult.split('\n').map((line, i) => (
                                        <p key={i} className="mb-2 text-slate-300 leading-relaxed">{line}</p>
                                    ))}
                                </div>
                            ) : (
                                <div className="flex flex-col items-center justify-center h-48 text-slate-500 text-center">
                                    <FileText size={48} className="mb-4 opacity-20" />
                                    <p>Upload a report and click 'Summarize' to see the AI analysis here.</p>
                                </div>
                            )}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    );
}
