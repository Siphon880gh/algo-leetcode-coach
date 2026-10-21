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
            'message' => "Read the problem statement above.\nGap formula?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i − prev − 1 (zeros between)', 'next' => 's2'],
                ['label' => 'i − prev', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That counts one too many.\nStep back to when you used i − prev.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Compare with index 0', 'next' => 'wrong_b'],
                ['label' => 'No check', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. There is no previous 1 yet.\nStep back to when you compared with 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always true', 'next' => 'success'],
                ['label' => 'Need a special case', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The formula handles it.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,0,0,0,1,0,0,1], 2 → true. [1,0,0,1,0,1], 2 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
