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
        
        <nav class="bg-white border-b border-gray-100 shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-xl font-bold text-indigo-600">
                            Course Review
                        </a>
                    </div>

                    <div class="flex items-center space-x-4">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 underline hover:text-indigo-500">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline hover:text-indigo-500">Iniciar Sesión</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline hover:text-indigo-500">Registrarse</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <main class="max-w-7xl mx-auto py-12 px-6">
            <div class="text-center mb-12">
                <h1 class="text-4xl font-extrabold text-gray-900">Explora nuestros cursos</h1>
                <p class="mt-4 text-lg text-gray-500">Descubre contenido creado por expertos y deja tu reseña.</p>
            </div>

            @if($courses->isEmpty())
                <div class="text-center text-gray-500 p-10">
                    <p>Aún no hay cursos disponibles.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($courses as $course)
                        <div class="bg-white overflow-hidden shadow-lg rounded-lg hover:shadow-xl transition-shadow duration-300">
                            <div class="p-6">
                                <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $course->title }}</h2>
                                <p class="text-sm text-indigo-600 font-medium mb-4">Instructor: {{ $course->instructor }}</p>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ Str::limit($course->description, 120) }}
                                </p>
                                <div class="mt-4 border-t pt-4">
                                    <span class="text-gray-400 text-sm cursor-not-allowed">Ver detalles (Próximamente)</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    {{ $courses->links() }}
                </div>
            @endif
        </main>

        <footer class="bg-white border-t border-gray-200 mt-12">
            <div class="max-w-7xl mx-auto py-6 px-4 text-center text-gray-500 text-sm">
                &copy; {{ date('Y') }} Course Review Platform. Todos los derechos reservados.
            </div>
        </footer>
    </div>
</body>
</html>