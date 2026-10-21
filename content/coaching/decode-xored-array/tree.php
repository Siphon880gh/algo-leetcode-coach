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
            'message' => "Read the problem statement above.\nRecover arr[i + 1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'arr[i] ^ encoded[i]', 'next' => 's2'],
                ['label' => 'encoded[i] − arr[i]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. XOR is its own inverse; subtraction is not.\nStep back to when you subtracted.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Output length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'len(encoded)', 'next' => 'wrong_b'],
                ['label' => 'len(encoded) + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The first element is added before the decoded ones.\nStep back to when you dropped first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extra space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the output array', 'next' => 'success'],
                ['label' => 'A hash map of values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each step needs only the previous value.\nStep back to when you added a map.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [1,0,2,1], [4,2,0,7,4].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
