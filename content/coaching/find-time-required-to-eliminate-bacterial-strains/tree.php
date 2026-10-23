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
            'message' => "Problem: Each bacterial strain needs a given time to eliminate, and one white blood cell starts. A cell can either eliminate one strain (and is then used up) or split into two cells, which takes a fixed split time. Return the least total time to eliminate every strain. Limits are in the official statement. (Restated from memory; limits and examples may differ slightly.)\nMerge which two?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two smallest', 'next' => 's2'],
                ['label' => 'The two largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 4, 1, 3, 6, 8], split 2 → 18 instead of 11.\nStep back to when you merged the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Merged value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + b + split', 'next' => 'wrong_b'],
                ['label' => 'b + split', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [3, 1, 2], split 1 → 8 instead of 4.\nStep back to when you added both.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Checks → 4, 11, 9.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
