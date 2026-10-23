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
            'message' => "Problem: You get a lowercase string. A run is a maximal block of one repeated letter. Choose as many runs as you can such that all chosen runs have the same length, and return how many you chose. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nWhat do you tally?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'How many runs have each length', 'next' => 's2'],
                ['label' => 'How many runs each letter has', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): \"aabbcdd\" → 1 instead of 3.\nStep back to when you grouped by letter.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of different lengths', 'next' => 'wrong_b'],
                ['label' => 'The largest tally', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"aabbcdd\" → 2 instead of 3.\nStep back to when you counted lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 3, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
