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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One scan with an inside flag', 'next' => 's2'],
                ['label' => 'Remove everything between the first and last |', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Text between two pairs is outside; Example 1 → 0 instead of 2.\nStep back to when you cut from the first to the last bar.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Flag starts as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Inside', 'next' => 'wrong_b'],
                ['label' => 'Outside', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That counts the stars inside pairs; Example 1 → 3 instead of 2.\nStep back to when you started inside.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count which characters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only *', 'next' => 'success'],
                ['label' => '* and the bar that opens each pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 4 instead of 2.\nStep back to when you counted the bar.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
