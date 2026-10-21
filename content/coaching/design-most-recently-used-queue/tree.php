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
            'message' => "Problem: Design a queue built from n that starts as [1, 2, …, n] and supports fetch(k): move the k-th element (1-indexed) to the end of the queue and return it. A follow-up typically asks for better than O(n) per call. For instance, with n = 8, fetch(3) → 3, fetch(5) → 6, fetch(2) → 2, fetch(8) → 2. (Restated from memory; limits and examples may differ slightly.)\nPlain list pop and append?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Correct but O(n) per fetch', 'next' => 's2'],
                ['label' => 'Already O(log n)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Removing from the middle shifts elements.\nStep back to when you called it logarithmic.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Find the k-th live element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Scan slots from the left', 'next' => 'wrong_b'],
                ['label' => 'Fenwick binary lifting on prefix counts', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A scan is O(n) again.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Tree size?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n plus the maximum number of fetch calls', 'next' => 'success'],
                ['label' => 'Exactly n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every fetch uses a new slot at the end.\nStep back to when you sized it at n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log(n + calls)) per fetch. Constructed check → 3, 6, 2, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
