<x-app-layout>
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold mb-4">Blog</h1>
            <p class="text-xl text-gray-600">Khám phá các bài viết về lập trình và công nghệ</p>
        </div>

        <!-- Categories -->
        <div class="mb-8">
            <div class="flex flex-wrap gap-4 justify-center">
                @foreach($categories as $category)
                <a href="{{ route('categories.show', $category) }}"
                   class="px-4 py-2 rounded-full border-2 border-primary hover:bg-primary hover:text-white transition-colors">
                    {{ $category->name }}
                    <span class="text-sm ml-1">({{ $category->posts_count }})</span>
                </a>
                @endforeach
            </div>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($posts as $post)
            <article class="card hover:shadow-lg transition-shadow">
                <img src="{{ $post->thumbnail }}"
                     alt="{{ $post->title }}"
                     class="w-full h-48 object-cover rounded-t-lg">

                <div class="p-6">
                    <!-- Category -->
                    <a href="{{ route('categories.show', $post->category) }}"
                       class="text-sm text-primary-600 font-medium hover:text-primary-800">
                        {{ $post->category->name }}
                    </a>

                    <!-- Title -->
                    <h2 class="mt-2 text-xl font-semibold">
                        <a href="{{ route('posts.show', $post) }}"
                           class="hover:text-primary-600 transition-colors">
                            {{ $post->title }}
                        </a>
                    </h2>

                    <!-- Excerpt -->
                    <p class="mt-3 text-gray-600">
                        {{ Str::limit($post->excerpt, 120) }}
                    </p>

                    <!-- Meta -->
                    <div class="mt-6 flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="{{ $post->user->avatar }}"
                                 alt="{{ $post->user->name }}"
                                 class="w-8 h-8 rounded-full">
                            <span class="ml-2 text-sm text-gray-600">
                                {{ $post->user->name }}
                            </span>
                        </div>
                        <span class="text-sm text-gray-500">
                            {{ $post->created_at->format('d/m/Y') }}
                        </span>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
