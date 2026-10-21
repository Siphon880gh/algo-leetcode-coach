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
            'message' => "Read the problem statement above.\nCompare teams by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Counts position by position', 'next' => 's2'],
                ['label' => 'Total points', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Ranking is lexicographic on the counts.\nStep back to when you summed points.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "All counts equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Order in the first vote', 'next' => 'wrong_b'],
                ['label' => 'Alphabetical order', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Ties go to the smaller letter.\nStep back to when you used the vote order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One vote?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return it', 'next' => 'success'],
                ['label' => 'Sort letters', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That vote is the ranking.\nStep back to when you sorted letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [\"ABC\",\"ACB\",\"ABC\",\"ACB\",\"ACB\"] → \"ACB\". [\"WXYZ\",\"XYZW\"] → \"XWYZ\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
