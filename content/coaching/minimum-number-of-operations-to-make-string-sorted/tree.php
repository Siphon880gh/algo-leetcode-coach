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
            'message' => "Read the problem statement above.\nSimulate the operations?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, count the rank', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The count can be astronomically large.\nStep back to when you simulated.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arrangements with a smaller letter at i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'rest!', 'next' => 'wrong_b'],
                ['label' => 'rest! / Π count! with that letter removed', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeated letters would be overcounted.\nStep back to when you ignored duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Division under the modulus?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Multiply by inverse factorials', 'next' => 'success'],
                ['label' => 'Integer division', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Reduced values cannot be divided directly.\nStep back to when you divided.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · n). Examples → 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
