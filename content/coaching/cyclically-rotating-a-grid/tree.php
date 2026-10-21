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
            'message' => "Read the problem statement above.\nRotate one step k times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, shift by k mod length', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. k reaches 10^9.\nStep back to when you looped k times.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "One modulus for all layers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, use the outer length', 'next' => 'wrong_b'],
                ['label' => 'No, each layer has its own length', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Inner layers are shorter.\nStep back to when you shared it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Write back order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The same cell order used to read', 'next' => 'success'],
                ['label' => 'Reverse order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The shift already encodes the direction.\nStep back to when you reversed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
