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
            'message' => "Read the problem statement above.\nDifferent lengths?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'False', 'next' => 's2'],
                ['label' => 'Pad', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Moves cannot add characters.\nStep back to when you padded.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shift needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '|t − s|', 'next' => 'wrong_b'],
                ['label' => '(t − s) mod 26', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Shifts wrap forward only.\nStep back to when you used absolute difference.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Same shift needed twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Second uses move d + 26', 'next' => 'success'],
                ['label' => 'Same move twice', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each move number is used once.\nStep back to when you reused it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"input\" → \"ouput\", 9 → true. \"abc\" → \"bcd\", 10 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
