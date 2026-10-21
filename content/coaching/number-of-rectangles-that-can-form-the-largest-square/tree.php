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
            'message' => "Read the problem statement above.\nSquare side from [l, w]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(l, w)', 'next' => 's2'],
                ['label' => 'max(l, w)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The square must fit inside both sides.\nStep back to when you used max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New larger side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add 1 to the count', 'next' => 'wrong_b'],
                ['label' => 'Reset the count to 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Earlier rectangles cannot reach the new maximum.\nStep back to when you kept counting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two passes needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One pass with reset works', 'next' => 'success'],
                ['label' => 'Must sort first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Sorting is unnecessary.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
