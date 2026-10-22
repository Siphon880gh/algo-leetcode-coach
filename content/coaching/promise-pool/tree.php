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
            'message' => "Problem: You get an array of asynchronous functions (each takes no arguments and returns a promise) and a pool limit n. Return a promise that runs them in order with at most n pending at any moment, starting the next one as soon as one finishes, and resolves when all have finished. The exact limits are in the official statement. For instance, functions that take 300, 400 and 200 ms finish after 500 ms with n = 2, after 900 ms with n = 1, and after 400 ms with n = 5. (Restated from memory; limits and examples may differ slightly.)\nWhen one function finishes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Start the next one right away', 'next' => 's2'],
                ['label' => 'Wait for the whole group of n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Waiting for a full group wastes slots; 300, 400 and 200 ms with n = 2 → 600 ms instead of 500.\nStep back to when you waited for the group.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "An empty array?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only resolve inside a completion handler', 'next' => 'wrong_b'],
                ['label' => 'Resolve immediately', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. No function ever completes; the promise never resolves instead of resolving at once.\nStep back to when you skipped the empty case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Total time follows the pool schedule. Constructed checks (run in Node) → 500, 900, 400 ms.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
