<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class filtersentences extends Command
{
    /**php
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:filtersentences {string} {max_word_count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Filter sentences based on max word count';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $string = $this->argument('string');
        $maxWordCount = $this->argument('max_word_count');

        // Split the string into sentences
        $sentences = preg_split('/(?<=[.!?])\s+/', $string, -1, PREG_SPLIT_NO_EMPTY);

        $filteredSentences = [];
        $wordCount = 0;

        foreach ($sentences as $sentence) {
            $wordCountInSentence = str_word_count($sentence);
            $wordCount += $wordCountInSentence;

            if ($wordCount <= $maxWordCount) {
                // Include the sentence along with the punctuation marks
                $filteredSentences[] = $sentence;
            } else {
                break;
            }
        }

        $output = implode(' ', $filteredSentences);

        $this->info($output);
    }
}
