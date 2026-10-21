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
            'message' => "Read the problem statement above.\nWhat do you try first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix sums mod k: equal remainders → a multiple of k in between', 'next' => 's2'],
                ['label' => 'Check every subarray sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All pairs of ends is O(n²) = 1e10.\nStep back to when you tried every subarray.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Remainder s seen before at index p.\nWhat must hold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i − p >= 1', 'next' => 'wrong_b'],
                ['label' => 'i − p >= 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A gap of 1 is a single element, which is not allowed.\nStep back to when you accepted i − p >= 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Seed {0: −1}. Store only the first index of each remainder. O(n).\nLock it in?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Seeded first-index map, gap ≥ 2', 'next' => 'success'],
                ['label' => 'Update the stored index every time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Overwriting with later indexes shortens gaps. [0,0] needs first[0] = −1 to reach a gap of 2.\nStep back to when you overwrote indexes.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. First index of each remainder, seed −1, gap at least 2. → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
