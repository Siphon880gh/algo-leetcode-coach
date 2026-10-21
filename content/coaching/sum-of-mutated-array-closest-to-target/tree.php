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
            'message' => "Read the problem statement above.\nFirst step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort the array', 'next' => 's2'],
                ['label' => 'Try every value up to target', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting lets you know which elements stay below the cap.\nStep back to when you tried every value.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Tie between two caps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The larger value', 'next' => 'wrong_b'],
                ['label' => 'The smaller value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The statement asks for the minimum on a tie.\nStep back to when you took the larger one.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No index fits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return max(arr)', 'next' => 'success'],
                ['label' => 'Return target', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A cap above the max changes nothing.\nStep back to when you returned target.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). [4,9,3], 10 → 3. [2,3,5], 10 → 5. Third example → 11361.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
