<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProcessSentences extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:sentences {input} {max_word_count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process sentences based on max word count';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $input = $this->argument('input');
        $maxWordCount = $this->argument('max_word_count');

        // Explode input string into sentences
        $sentences = preg_split('/(?<=[.?!])\s+(?=[a-z])/i', $input, -1, PREG_SPLIT_NO_EMPTY);

        // Process sentences based on max word count
        $result = [];
        foreach ($sentences as $sentence) {
            // Count the words in the sentence
            $words = str_word_count($sentence);
            if ($words <= $maxWordCount) {
                $result[] = $sentence;
            }
        }

        // Output the processed sentences
        if (empty($result)) {
            $this->info("No sentences found within the specified word count limit.");
        } else {
            $this->info("Processed sentences:");
            foreach ($result as $sentence) {
                $this->line($sentence);
            }
        }

        return 0;
    }
}
