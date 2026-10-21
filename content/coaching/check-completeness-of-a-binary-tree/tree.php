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
            'message' => "Read the problem statement above.\nEnqueue null children?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes: they mark the gaps', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Without them you cannot see where a gap is.\nStep back to when you skipped nulls.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A real node appears after a null. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Continue', 'next' => 'wrong_b'],
                ['label' => 'Return false', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A complete tree fills positions with no gaps.\nStep back to when you continued.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Is checking only the last level enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: a gap in any level breaks completeness', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every level but the last must be full.\nStep back to when you checked one level.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [1,2,3,4,5,6] → true. [1,2,3,4,5,null,7] → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
