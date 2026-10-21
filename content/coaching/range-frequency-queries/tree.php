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
            'message' => "Read the problem statement above.\nAnswer each query how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Binary search the value\'s index list', 'next' => 's2'],
                ['label' => 'Scan arr[left … right]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 10^5 queries over 10^5 elements is too slow.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count positions in [l, r]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bisect_left(r) − bisect_left(l)', 'next' => 'wrong_b'],
                ['label' => 'bisect_right(r) − bisect_left(l)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That misses an occurrence at index r; query(1, 2, 4) would give 0 instead of 1.\nStep back to when you used bisect_left for r.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A value that never occurs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 'success'],
                ['label' => 'Look it up anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A missing key must give 0, not an error.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) build, O(log n) per query. Example → [null,1,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
