@php
    $isNotChrome = strpos(request()->header('User-Agent'), 'Chrome') === false;
@endphp

<x-app-layout>
    
    <x-slot name="header">
        @if ($isNotChrome)
        <div class="max-w-7xl mx-auto bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
            <div class="flex">
                <div class="py-1">
                <svg class="fill-current h-6 w-6 text-blue-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M10 0C4.5 0 0 4.5 0 10s4.5 10 10 10 10-4.5 10-10S15.5 0 10 0zM9 5h2v6H9V5zm0 8h2v2H9v-2z"/></svg>
                </div>
                <div>
                <p class="font-bold">Browser Compatibility Notice</p>
                <p class="text-sm">For the best experience, please use Chrome as text-to-speech functionality may not work well in other browsers.</p>
                </div>
            </div>
        </div>
        @endif
    </x-slot>
   
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach ($words as $index => $word)
                            <div class="word-bank border p-6 rounded-lg shadow-lg transition-transform text-center cursor-pointer duration-100 active:scale-95" data-word="{{ $word['word'] }}">
                                <p class="font-bold text-3xl">{{ $word['word'] }}</p>
                                <p class="text-xl">{{ $word['pinyin'] }}</p>
                                <p class="text-lg text-gray-500">{{ $word['meaning'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> 
</x-app-layout>

<script>
     document.addEventListener('DOMContentLoaded', function() {
        let voices = [];

        speechSynthesis.onvoiceschanged = () => {
            voices = speechSynthesis.getVoices();
        };

        document.querySelectorAll('.word-bank').forEach(card => {
            card.addEventListener('click', function() {
                const word = this.getAttribute('data-word');
                const utterance = new SpeechSynthesisUtterance(word);
                const mandarinVoice = voices.find(voice => voice.lang === 'zh-CN' || voice.lang === 'zh-TW');
                if (mandarinVoice) {
                    utterance.voice = mandarinVoice;
                }
                utterance.rate = 0.7; // Slower rate
                speechSynthesis.speak(utterance);

                const wordBank = document.querySelectorAll('word-bank');

                wordBank.classList.add('scale-95');
                    // setTimeout(() => {
                    //     wordBank.classList.remove('scale-95');
                    // }, 100);
                });
        });
    });
</script>