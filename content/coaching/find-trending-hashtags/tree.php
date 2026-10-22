<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: A table lists tweets with a date and text. Within the period the statement gives, extract each tweet’s hashtag, count how often each hashtag appears, and report the most frequent ones (as many as the statement asks) with their counts. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHashtag ends at?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first space after #', 'next' => 's2'],
                ['label' => 'The end of the text', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. #Sunny today and #Sunny vibes become different tags.\nStep back to when you took the rest of the text.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Date filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All tweets', 'next' => 'wrong_b'],
                ['label' => 'The stated period only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s constructed check, a March tweet pushes #Rainy to 3.\nStep back to when you dropped the filter.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Group by tag, order and limit as asked.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
