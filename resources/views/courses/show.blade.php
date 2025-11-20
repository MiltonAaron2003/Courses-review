<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->title }} - Detalle del Curso</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans antialiased">
    <nav class="bg-white border-b border-gray-100 p-4 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center text-indigo-600 hover:text-indigo-800 font-bold text-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Volver a los cursos
            </a>
            <div>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 underline hover:text-indigo-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 underline hover:text-indigo-500">Iniciar Sesión</a>
                @endauth
            </div>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto py-10 px-6">
        @if(session('success'))
            <div class="mb-8 p-4 bg-green-100 text-green-700 border-l-4 border-green-500 rounded shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white overflow-hidden shadow-lg rounded-lg mb-10">
            <div class="p-8">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4">{{ $course->title }}</h1>
                <div class="flex items-center text-sm text-gray-500 mb-6">
                    <span class="bg-indigo-100 text-indigo-800 py-1 px-3 rounded-full font-semibold">Instructor: {{ $course->instructor }}</span>
                    <span class="mx-2">•</span>
                    <span>Publicado el {{ $course->created_at->format('d/m/Y') }}</span>
                </div>
                
                <div class="prose max-w-none text-gray-700 leading-relaxed border-t pt-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Descripción del Curso</h3>
                    <p>{{ $course->description }}</p>
                </div>
            </div>
        </div>

        <div class="mb-10 bg-gray-50 p-6 rounded-lg border border-gray-200">
            @auth
                <h3 class="text-lg font-bold text-gray-900 mb-4">Deja tu reseña</h3>
                <form action="{{ route('reviews.store', $course->slug) }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700 mb-1">Calificación (1-5)</label>
                        <select name="rating" id="rating" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="5">⭐⭐⭐⭐⭐ (5 - Excelente)</option>
                            <option value="4">⭐⭐⭐⭐ (4 - Muy bueno)</option>
                            <option value="3">⭐⭐⭐ (3 - Bueno)</option>
                            <option value="2">⭐⭐ (2 - Regular)</option>
                            <option value="1">⭐ (1 - Malo)</option>
                        </select>
                        @error('rating') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700 mb-1">Comentario</label>
                        <textarea name="comment" id="comment" rows="3" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Comparte tu experiencia..."></textarea>
                        @error('comment') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Enviar Reseña
                    </button>
                </form>
            @else
                <div class="text-center">
                    <p class="text-gray-600 mb-3">¿Quieres dejar tu opinión sobre este curso?</p>
                    <a href="{{ route('login') }}" class="text-indigo-600 font-bold hover:underline">Inicia sesión para dejar una reseña</a>
                </div>
            @endauth
        </div>

        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                Reseñas de Estudiantes
                <span class="ml-3 bg-gray-200 text-gray-700 text-sm py-1 px-3 rounded-full">{{ $course->reviews->count() }}</span>
            </h2>

            <div class="space-y-6">
                @forelse ($course->reviews as $review)
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-gray-100">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <div class="font-bold text-gray-800 text-lg">{{ $review->user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="flex items-center bg-yellow-50 px-3 py-1 rounded-full border border-yellow-100">
                                <span class="text-yellow-500 text-lg mr-1">★</span>
                                <span class="font-bold text-gray-700">{{ $review->rating }}/5</span>
                            </div>
                        </div>
                        <p class="text-gray-600 italic">"{{ $review->comment }}"</p>
                    </div>
                @empty
                    <div class="text-center py-12 bg-white rounded-lg border-2 border-dashed border-gray-300">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                        <p class="mt-2 text-gray-500 font-medium">Aún no hay reseñas para este curso.</p>
                        <p class="text-sm text-gray-400">¡Sé el primero en compartir tu opinión!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </main>
    
    <footer class="bg-white border-t border-gray-200 mt-12 py-6 text-center text-gray-500 text-sm">
        &copy; {{ date('Y') }} Plataforma de Cursos.
    </footer>
</body>
</html>