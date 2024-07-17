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
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <div id="flashcard" class="flashcard border p-6 rounded-lg shadow-lg mb-4 transition-transform">
                        <p id="word" class="font-bold" style="font-size: 72px;"></p>
                        <p id="pinyin" class="text-xl"></p>
                        <p id="meaning" class="text-lg text-gray-500"></p>
                    </div>
                    <button id="speak" 
                            class="mt-4 px-4 py-2 bg-transparent dark:text-gray-200 rounded hover:bg-transparent transition" 
                            @if($isNotChrome) 
                            disabled 
                            style="cursor: not-allowed; opacity: 0.5;" 
                            @endif>
                    Speak
                    </button>
                    <button id="next" class="mt-4 px-4 py-2 bg-gray-200 dark:bg-gray-900 dark:text-gray-200 rounded dark:hover:bg-gray-900 transition">Next</button>
                </div>
            </div>
        </div>
    </div> 
</x-app-layout>

<script>
    const flashcards = @json($flashcards);
    let currentIndex = 0;

    // Shuffle function to randomize the flashcards array
    function shuffle(array) {
        let currentIndex = array.length, randomIndex;

        while (currentIndex !== 0) {
            randomIndex = Math.floor(Math.random() * currentIndex);
            currentIndex--;
            [array[currentIndex], array[randomIndex]] = [array[randomIndex], array[currentIndex]];
        }

        return array;
    }

    // Randomize flashcards array
    shuffle(flashcards);

    function showFlashcard(index) {
        if (index >= flashcards.length) {
            index = 0; // loop back to the beginning
        }
        const flashcard = flashcards[index];

        document.getElementById('word').textContent = flashcard.word;
        document.getElementById('pinyin').textContent = flashcard.pinyin;
        document.getElementById('meaning').textContent = flashcard.meaning;
        currentIndex = index;
    }

    document.getElementById('next').addEventListener('click', function() {
        const flashcardElement = document.getElementById('flashcard');
        
        flashcardElement.classList.add('fade-out');

        setTimeout(() => {
            showFlashcard(currentIndex + 1);
            flashcardElement.classList.remove('fade-out');
            flashcardElement.classList.add('fade-in');

            setTimeout(() => {
                flashcardElement.classList.remove('fade-in');
            }, 300);
        }, 300);
    });

    let voices = [];

    speechSynthesis.onvoiceschanged = () => {
        voices = speechSynthesis.getVoices();
    };

    // Text-to-Speech functionality
    document.getElementById('speak').addEventListener('click', function() {
        const word = document.getElementById('word').textContent;
        const utterance = new SpeechSynthesisUtterance(word);
        const mandarinVoice = voices.find(voice => voice.lang === 'zh-CN' || voice.lang === 'zh-TW');
        if (mandarinVoice) {
            utterance.voice = mandarinVoice;
        }
        speechSynthesis.speak(utterance);
      
    });

    // Show the first flashcard initially
    showFlashcard(currentIndex);
</script>

<style>
    .fade-out {
        transform: translateX(-100%);
        opacity: 0;
    }
    
    .fade-in {
        transform: translateX(100%);
        opacity: 0;
    }

    .fade-in-active {
        transform: translateX(0);
        opacity: 1;
    }

    .transition-transform {
        transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
    }
</style>
