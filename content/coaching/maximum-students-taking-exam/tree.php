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
            'message' => "Read the problem statement above.\nWithin a row, forbid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Adjacent seats', 'next' => 's2'],
                ['label' => 'Nothing', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Left and right neighbours can see each other.\nStep back to when you allowed them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Between rows, forbid?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The seat directly in front', 'next' => 'wrong_b'],
                ['label' => 'Diagonal neighbours', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only upper-left and upper-right are visible.\nStep back to when you forbade the front seat.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Broken seats?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Mask must avoid them', 'next' => 'success'],
                ['label' => 'Allowed', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. # seats cannot be used.\nStep back to when you used them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · 4ⁿ). Examples → 4, 3, 10.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
