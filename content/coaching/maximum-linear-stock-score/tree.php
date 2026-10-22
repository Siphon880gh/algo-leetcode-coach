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
            'message' => "Problem: Given an array of stock prices by day, choose days so that between any two consecutive chosen days the price changes by exactly the number of days between them. The score is the sum of the chosen prices; return the largest score. Indexing and limits are in the official statement. For instance, [1, 5, 3, 7, 8] → 20 and [5, 6, 7, 8, 9] → 35. (Restated from memory; limits and examples may differ slightly.)\nGroup key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'price − index', 'next' => 's2'],
                ['label' => 'price + index', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That matches prices falling one per day; [1, 5, 3, 7, 8] → 8 instead of 20.\nStep back to when you added.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The single largest price', 'next' => 'wrong_b'],
                ['label' => 'The largest group sum', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 5, 3, 7, 8] → 8 instead of 20.\nStep back to when you took one price.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1, 5, 3, 7, 8] → 20, [5, 6, 7, 8, 9] → 35.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
