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
            'message' => "Read the problem statement above.\nProduct for a cut?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 's · (total − s)', 'next' => 's2'],
                ['label' => 's · total', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The other part is total − s.\nStep back to when you used total.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Apply the modulo when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before comparing', 'next' => 'wrong_b'],
                ['label' => 'After choosing the max', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Reduced values do not compare correctly.\nStep back to when you reduced early.",
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
            'message' => "You are wrong. Products can exceed 32 bits.\nStep back to when you used 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,5,6] → 110. Second example → 90.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
