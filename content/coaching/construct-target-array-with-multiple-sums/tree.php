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
            'message' => "Read the problem statement above.\nWhich value to undo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest', 'next' => 's2'],
                ['label' => 'The smallest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The last replaced value equals the old total, so it is the largest.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Undo by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'm − rest once', 'next' => 'wrong_b'],
                ['label' => 'm mod rest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Single subtractions are too slow for [1, 10⁹].\nStep back to when you subtracted once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "rest == 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return true', 'next' => 'success'],
                ['label' => 'Continue', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Any value can be reduced to 1.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + log(max) · log n). [9,3,5] → true. [1,1,1,2] → false. [8,5] → true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
