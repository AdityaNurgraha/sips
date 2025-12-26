<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your account\'s profile information, email address, and profile photo.') }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('PATCH')

        {{-- FOTO PROFIL --}}
        <div class="flex items-center gap-4">
            <img id="imagePreview"
                 src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default-avatar.png') }}"
                 class="w-24 h-24 rounded-full object-cover border"
                 alt="Foto Profil">

            <div>
                <input id="photoInput"
                       type="file"
                       name="photo"
                       accept="image/*"
                       class="border p-2 rounded"
                       onchange="previewImage(event)">

                @error('photo')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror

                <p class="text-xs text-gray-500 mt-1">Max 2MB • JPG, PNG, WebP</p>
            </div>
        </div>

        {{-- NAMA --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">{{ __('Name') }}</label>
            <input id="name" name="name" type="text"
                   class="mt-1 block w-full border rounded p-2"
                   value="{{ old('name', $user->name) }}" required>

            @error('name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                   class="mt-1 block w-full border rounded p-2"
                   value="{{ old('email', $user->email) }}" required>

            @error('email')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p class="text-sm text-green-600">Saved.</p>
            @endif
        </div>
    </form>
</section>

{{-- SCRIPT PREVIEW FOTO --}}
<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (!file) return;

        const img = document.getElementById('imagePreview');
        img.src = URL.createObjectURL(file);

        img.onload = () => URL.revokeObjectURL(img.src);
    }
</script>
