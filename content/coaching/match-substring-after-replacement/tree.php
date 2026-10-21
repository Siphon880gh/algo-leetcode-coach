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
            'message' => "Read the problem statement above.\nMapping direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only old in sub to new in s', 'next' => 's2'],
                ['label' => 'Either direction', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → true instead of false: 0 cannot become o.\nStep back to when you allowed both directions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the first where sub[0] matches', 'next' => 'wrong_b'],
                ['label' => 'Every start', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s = aab, sub = ab → false instead of true.\nStep back to when you stopped at the first start.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A letter with two mappings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep both as pairs', 'next' => 'success'],
                ['label' => 'Store one per letter in a map', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 has t → 7 and t → 8; keeping only the last → false instead of true.\nStep back to when you kept one mapping per letter.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| · |sub|). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
