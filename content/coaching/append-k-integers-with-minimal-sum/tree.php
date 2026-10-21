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
            'message' => "Read the problem statement above.\nFind the missing numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Arithmetic sum over each gap', 'next' => 's2'],
                ['label' => 'Step through integers one by one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. k reaches 10^8, which is too many single steps.\nStep back to when you stepped one by one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Duplicates in nums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Walk the sorted array as is', 'next' => 'wrong_b'],
                ['label' => 'Remove them before walking gaps', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 has 25 twice; that gap is 25 − 25 − 1 = −1 and would hand back a number.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Integer width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The sum can reach about 10^17.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 5, 25.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
