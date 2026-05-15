<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-[#4CAF50] to-[#2196F3] border border-transparent rounded-xl font-bold text-xs text-white uppercase tracking-widest hover:from-[#45a049] hover:to-[#1e88e5] hover:shadow-[0_0_20px_rgba(76,175,80,0.4)] focus:outline-none focus:ring-2 focus:ring-[#4CAF50] focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition-all ease-in-out duration-300 hover:scale-[1.02]']) }}>
    {{ $slot }}
</button>
