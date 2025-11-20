<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Plataforma de Cursos</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <div class="min-h-screen">
        
        <nav class="bg-white border-b border-gray-100 shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600 tracking-tight">
                            Course Review
                        </a>
                    </div>
                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 transition">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <div class="bg-indigo-600 text-white py-16">
            <div class="max-w-7xl mx-auto px-6 text-center">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-4">Aprende y Comparte</h1>
                <p class="text-lg md:text-xl text-indigo-100 max-w-2xl mx-auto">Descubre los mejores cursos calificados por la comunidad y comparte tu experiencia de aprendizaje.</p>
            </div>
        </div>

        <main class="max-w-7xl mx-auto py-12 px-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-8 border-l-4 border-indigo-500 pl-4">Últimos Cursos Agregados</h2>

            @if($courses->isEmpty())
                <div class="text-center py-20 bg-white rounded-lg shadow-sm">
                    <p class="text-gray-500 text-lg">Aún no hay cursos disponibles en la plataforma.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($courses as $course)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 flex flex-col h-full border border-gray-100 overflow-hidden group">
                            <div class="p-6 flex-grow">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="bg-indigo-50 text-indigo-700 text-xs font-bold px-2 py-1 rounded uppercase tracking-wide">Curso</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-indigo-600 transition-colors">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-500 mb-4 font-medium">Por: {{ $course->instructor }}</p>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    {{ Str::limit($course->description, 120) }}
                                </p>
                            </div>
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                                <a href="{{ route('courses.show', $course->slug) }}" class="block w-full text-center text-indigo-600 font-semibold hover:text-indigo-800 transition-colors">
                                    Ver detalles y reseñas &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $courses->links() }}
                </div>
            @endif
        </main>
    </div>
</body>
</html>