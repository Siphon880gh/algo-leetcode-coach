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
            'message' => "Read the problem statement above.\nCan a subarray repeat?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: take k different subarrays', 'next' => 's2'],
                ['label' => 'Yes, reuse the best one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 3, 2], k = 3 → 6 instead of 5.\nStep back to when you reused it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Heap start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the whole array, pushing (l + 1, r) after a pop', 'next' => 'wrong_b'],
                ['label' => 'Every l with r = n − 1, pushing (l, r − 1) after a pop', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 3, 2], k = 3 → 3 instead of 5.\nStep back to when you started from one subarray.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + k log n). Examples → 4, 12.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
