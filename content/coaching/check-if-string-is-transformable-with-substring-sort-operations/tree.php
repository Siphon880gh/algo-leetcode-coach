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
            'message' => "Read the problem statement above.\nWhat can a sort do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move a digit left past larger digits only', 'next' => 's2'],
                ['label' => 'Any permutation', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Sorting never moves a digit left past a smaller one.\nStep back to when you allowed any order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Check for digit d at its next position p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only that counts match', 'next' => 'wrong_b'],
                ['label' => 'No digit < d still pending before p', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal multisets are not sufficient.\nStep back to when you compared counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop p from d\'s queue', 'next' => 'success'],
                ['label' => 'Leave it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That occurrence is now used.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(10 · n). Example 1 → true. Example 2 → true. \"12345\" → \"12435\" → false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
