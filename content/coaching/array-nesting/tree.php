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
            'message' => "Read the problem statement above.\nFollow i → nums[i] from every start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: each index is on exactly one cycle, so visit each index once', 'next' => 's2'],
                ['label' => 'Yes: walk from every start', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Starting from every index re-walks whole cycles: O(n²) when the permutation is one big cycle.\nStep back to when you walked every start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How do you avoid re-walking a cycle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop when you come back to the start, with no marks', 'next' => 'wrong_b'],
                ['label' => 'Mark visited indexes (or set nums[i] = n) and skip them later', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That ends one walk, but the next start on the same cycle walks it again.\nStep back to when you skipped the marks.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What is the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The length of the longest cycle', 'next' => 'success'],
                ['label' => 'The number of cycles', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. S[k] is the cycle through k, and the question asks for its largest size.\nStep back to when you counted cycles.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Mark and measure each permutation cycle: O(n) time, O(1) extra with in-place marks. [5,4,0,3,1,6,2] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
