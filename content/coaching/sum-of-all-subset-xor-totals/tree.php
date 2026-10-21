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
            'message' => "Read the problem statement above.\nWhich bits contribute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Bits set in any element (the OR)', 'next' => 's2'],
                ['label' => 'Bits set in the XOR of all', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A bit cancelling in the full XOR still appears in other subsets.\nStep back to when you used the total XOR.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Subsets with a given bit on?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 2^n', 'next' => 'wrong_b'],
                ['label' => 'Exactly half: 2^(n − 1)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Toggling one element with that bit pairs subsets on and off.\nStep back to when you counted all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Empty subset?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Contributes 0', 'next' => 'success'],
                ['label' => 'Excluded and changes the count', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It is included and adds 0.\nStep back to when you excluded it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 28, 480.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
