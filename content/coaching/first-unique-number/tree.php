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
            'message' => "Problem: Design a class built from an initial list that supports adding a number and reporting the first number in the queue that appears exactly once, or −1. For instance, starting from [2,3,5]: 2; add 5 → 2; add 2 → 3; add 3 → −1. (Restated from memory; limits and examples may differ slightly.)\nOn add(x)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it; enqueue on first sight', 'next' => 's2'],
                ['label' => 'Enqueue every time', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Duplicates are never unique.\nStep back to when you enqueued every add.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Query cost?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan the queue', 'next' => 'wrong_b'],
                ['label' => 'Amortised O(1) lazy pops', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Scanning is O(n) per query.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No unique left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. −1 signals none.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Amortised O(1). [2,3,5]: 2 → add 5: 2 → add 2: 3 → add 3: −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
