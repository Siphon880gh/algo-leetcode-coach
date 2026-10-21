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
            'message' => "Read the problem statement above.\nWhy does \"01\" signal a second segment?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The string starts with 1, so a later 1 after a 0 starts another', 'next' => 's2'],
                ['label' => 'It does not', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The leading 1 guarantees the first segment.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count segments explicitly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Required', 'next' => 'wrong_b'],
                ['label' => 'Possible, but the pattern test suffices', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One substring check is enough.\nStep back to when you insisted on counting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Look for \"10\"?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, "110" is valid', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Ones followed by zeros is still one segment.\nStep back to when you searched for 10.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
