@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-[#4CAF50] focus:ring-[#4CAF50] rounded-xl shadow-sm hover:border-gray-400 dark:hover:border-gray-500 focus:shadow-[0_0_15px_rgba(76,175,80,0.2)] transition-all duration-300']) }}>
