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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Enumerate all 2^R subsets', 'next' => 's2'],
                ['label' => 'Greedy cycles', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Overlapping cycles defeat greedy choices.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Valid subset?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every building appears', 'next' => 'wrong_b'],
                ['label' => 'Every building\'s net change is 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only balance matters.\nStep back to when you checked appearance.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Self request [i, i]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always safe to include', 'next' => 'success'],
                ['label' => 'Never allowed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It changes nothing.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^R · (R + n)). Examples → 5, 3, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
