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
            'message' => "Read the problem statement above.\nNeighbours in the alphabet?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Difference 1 or 25 (a and z too)', 'next' => 's2'],
                ['label' => 'Difference 1 only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → zadb instead of db.\nStep back to when you forgot the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare the new letter with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The previous input letter', 'next' => 'wrong_b'],
                ['label' => 'The current stack top', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ccbb → cb instead of \"\".\nStep back to when you compared with the input.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → c, \"\", db.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
