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
            'message' => "Read the problem statement above.\nCompare word by word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: compare characters across words', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. ['ab','c'] equals ['a','bc'].\nStep back to when you compared words.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both streams end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore leftovers', 'next' => 'wrong_b'],
                ['label' => 'Must end together', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extra characters make them different.\nStep back to when you ignored leftovers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Simplest approach here?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Join and compare (≤ 1000 chars)', 'next' => 'success'],
                ['label' => 'Hash every prefix', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is needless work.\nStep back to when you hashed.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
