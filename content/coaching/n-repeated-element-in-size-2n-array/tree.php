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
            'message' => "Read the problem statement above.\nCount every value with a map?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed: the first repeat is the answer', 'next' => 's2'],
                ['label' => 'Yes, then find the count of n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only one value repeats at all.\nStep back to when you counted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "For O(1) space, how far apart must two copies sometimes be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Within distance 1', 'next' => 'wrong_b'],
                ['label' => 'Within distance 3', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,2,3,1] has copies at distance 3 only.\nStep back to when you checked only neighbors.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Sort and compare neighbors?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Works, but O(n log n)', 'next' => 'success'],
                ['label' => 'It is the fastest way', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A set is O(n).\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,3] → 3. [2,1,2,5,3,2] → 2. [5,1,5,2,5,3,5,4] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
