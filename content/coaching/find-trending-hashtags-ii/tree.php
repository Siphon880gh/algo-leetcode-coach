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
            'message' => "Problem: A table lists tweets with a date and text, and a tweet can carry more than one hashtag. Within the period the statement gives, count every hashtag occurrence and report the most frequent hashtags (as many as the statement asks) with their counts. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nHashtags per tweet?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them', 'next' => 's2'],
                ['label' => 'Only the first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. In the guide’s check, #Sunny drops to 2 and #Win to 1.\nStep back to when you took the first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Date filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All tweets', 'next' => 'wrong_b'],
                ['label' => 'The stated period', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In the guide’s check, a March tweet adds two #Rainy, tying #Sunny at 3.\nStep back to when you dropped the filter.",
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
