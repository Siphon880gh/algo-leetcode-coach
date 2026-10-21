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
            'message' => "Read the problem statement above.\nWhen to merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'gcd(top, x) > 1', 'next' => 's2'],
                ['label' => 'gcd(top, x) = 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Coprime numbers are the ones that stay apart.\nStep back to when you merged on gcd 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After one merge?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push and move on', 'next' => 'wrong_b'],
                ['label' => 'Check the new top again', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [2,3,6] → [6], but merging once gives [2,6].\nStep back to when you stopped after one merge.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which pair to merge first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any: the result is the same', 'next' => 'success'],
                ['label' => 'Search every merge order', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement says any order gives the same result, and the search is exponential.\nStep back to when you searched orders.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log max). Examples → [12,7,6], [2,1,1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
