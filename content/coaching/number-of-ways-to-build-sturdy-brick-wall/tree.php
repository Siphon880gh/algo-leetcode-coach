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
            'message' => "Problem: You are given height, width and a list of brick widths; every brick is 1 unit tall, supply is unlimited, and bricks cannot be rotated. Each row must be exactly width long. The wall is sturdy when adjacent rows never have a joint between bricks at the same position, except at the two ends. Return the number of sturdy walls modulo 10^9 + 7. The width is small. For instance, height 2, width 3, bricks [1,2] → 2; height 1, width 1, bricks [5] → 0. (Restated from memory; limits and examples may differ slightly.)\nCount rows independently?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: DP over compatible neighbours', 'next' => 's2'],
                ['label' => 'Yes: patterns^height', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Height 2, width 3, bricks [1,2] → 9 instead of 2.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When are two rows compatible?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The two patterns differ', 'next' => 'wrong_b'],
                ['label' => 'Joint masks AND to 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1,1,1] and [1,2] differ but share the joint at 1.\nStep back to when you only required a difference.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mark position width as a joint?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: only inner joints', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every row ends at width, so no two rows would ever fit.\nStep back to when you marked the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(height · R²). Constructed cases → 2, 0, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
