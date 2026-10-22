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
            'message' => "Problem: Add a method to every sorted array of numbers that returns the last index holding a given target, or −1 if the target is absent. The method name and limits are in the official statement. For instance, [3, 4, 5] with target 5 → 2, [1, 4, 5] with target 2 → −1, and [3, 4, 6, 6, 6, 6, 7] with target 6 → 5. (Restated from memory; limits and examples may differ slightly.)\nSearch for?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first index with a value greater than the target', 'next' => 's2'],
                ['label' => 'Use indexOf', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That finds the first copy; in Node the third example → 2 instead of 5.\nStep back to when you used indexOf.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lo − 1', 'next' => 'wrong_b'],
                ['label' => 'lo − 1 if it holds the target, else −1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The target may be absent; in Node [1, 4, 5] with 2 → 0 instead of −1.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). The examples → 2, −1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
