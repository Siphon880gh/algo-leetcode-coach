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
            'message' => "Read the problem statement above.\nBuild all k copies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: at most two copies matter', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That can be 10¹⁰ elements.\nStep back to when you built them all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do middle copies help?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always', 'next' => 'wrong_b'],
                ['label' => 'Only if sum(arr) > 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A non-positive copy only lowers the sum.\nStep back to when you always added them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "All values negative. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0: the empty subarray', 'next' => 'success'],
                ['label' => 'The largest value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Here the empty subarray is allowed.\nStep back to when you forced an element.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2], k = 3 → 9. [1,−2,1], k = 5 → 2. [−1,−2], k = 7 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
