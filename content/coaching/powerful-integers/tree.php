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
            'message' => "Read the problem statement above.\nTest every number up to the bound?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: enumerate the few powers', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Powers below 10⁶ are only about 20 per base.\nStep back to when you tested every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "x = 1. What goes wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing', 'next' => 'wrong_b'],
                ['label' => 'x^i is always 1, so the loop never ends; break after one step', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The power never grows past the bound.\nStep back to when you ignored base 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why use a set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Different (i, j) pairs can give the same sum', 'next' => 'success'],
                ['label' => 'To sort the result', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Duplicates must appear once; order does not matter.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log x · log y). x = 2, y = 3, bound = 10 → [2,3,4,5,7,9,10]. x = 3, y = 5, bound = 15 → [2,4,6,8,10,14].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
