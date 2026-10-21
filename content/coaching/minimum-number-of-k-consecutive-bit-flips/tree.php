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
            'message' => "Read the problem statement above.\nThe leftmost 0 must be fixed by which flip?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one starting at it', 'next' => 's2'],
                ['label' => 'Any flip covering it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Flips starting earlier would disturb bits already fixed.\nStep back to when you allowed any flip.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you apply a flip without touching k bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Flip each bit in the window', 'next' => 'wrong_b'],
                ['label' => 'Keep a count of active flips and mark where each ends', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That is O(n · k).\nStep back to when you flipped every bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "You need a flip at i but i + k > n. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '−1', 'next' => 'success'],
                ['label' => 'Skip it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That 0 can never be fixed.\nStep back to when you skipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,1,0], k = 1 → 2. [1,1,0], k = 2 → −1. [0,0,0,1,0,1,1,0], k = 3 → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
