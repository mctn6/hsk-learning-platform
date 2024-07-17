<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Flashcards') }}
        </h2>
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
                    <button id="speak" class="mt-4 px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition">Speak</button>
                    <button id="next" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition">Next</button>
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

    // Text-to-Speech functionality
    document.getElementById('speak').addEventListener('click', function() {
        const word = document.getElementById('word').textContent;
        const utterance = new SpeechSynthesisUtterance(word);
        utterance.lang = 'zh-CN'; // Set language to Mandarin
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
