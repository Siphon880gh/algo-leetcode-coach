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
            'message' => "State:\nnums = [5,1,9,3,7,8], k=3 largest\nmin-heap size ≤3\n\nAfter all, heap top is?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '7 — smallest of the three largest', 'next' => 'mid'],
                ['label' => '9 — as if it were a max-heap of everything', 'next' => 'w1'],
            ],
        ],
        'w1' => [
            'message' => "Wrong.\n\nA min-heap of the top-k has the k-th largest at the top.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        'mid' => [
            'message' => "State:\nheap holds 7,8,9 (min-heap), next x=6\n\nAction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore 6 — not larger than top 7', 'next' => 'final'],
                ['label' => 'Push 6 anyway — size may exceed k', 'next' => 'w2'],
            ],
        ],
        'w2' => [
            'message' => "Wrong.\n\nOnly beat-the-top values enter when size is k.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'mid',
            'choices' => [],
        ],
        'final' => [
            'message' => "State:\nk ≪ n\n\nTime for size-k heap method?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'O(n log k)', 'next' => 'success'],
                ['label' => 'O(n log n) required', 'next' => 'w3'],
            ],
        ],
        'w3' => [
            'message' => "Wrong.\n\nEach of n items pays O(log k) heap ops.\n\nStep back.",
            'outcome' => 'wrong',
            'rewind_to' => 'final',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct.\n\n- Min-heap of size k for top-k largest\n- O(n log k)\n\nYou finished this path.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
