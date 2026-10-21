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
            'message' => "Problem: Rotating a digit by 180° turns 0, 1, 6, 8, 9 into 0, 1, 9, 8, 6; the digits 2, 3, 4, 5, 7 become invalid. A number is confusing when its rotation is valid and differs from the original (leading zeros are ignored). Return whether n is confusing. 6 → true. 89 → true. 11 → false. 25 → false. (Restated from memory; limits and examples may differ slightly.)\nDoes rotation keep the digit order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the last digit becomes the first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A 180° turn reverses the number.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You read a 7. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A 7 cannot be rotated into a digit.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The rotated number equals n. Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'false', 'next' => 'success'],
                ['label' => 'true', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Confusing means the rotation is different.\nStep back to when you said true.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). 6 → true. 89 → true. 11 → false. 25 → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
