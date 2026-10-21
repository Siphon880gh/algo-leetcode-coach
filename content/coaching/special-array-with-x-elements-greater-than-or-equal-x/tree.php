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
            'message' => "Read the problem statement above.\nCandidate range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0 … n', 'next' => 's2'],
                ['label' => 'Values of the array only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. x need not appear in nums.\nStep back to when you used array values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Uniqueness?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Several may work', 'next' => 'wrong_b'],
                ['label' => 'At most one x works', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The count of elements ≥ x is non-increasing in x, so at most one x can equal it.\nStep back to when you collected many.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "None found?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return −1', 'next' => 'success'],
                ['label' => 'Return 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 0 works only if no element is ≥ 0, which cannot happen here.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [3,5] → 2. [0,0] → −1. [0,4,3,0,4] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
