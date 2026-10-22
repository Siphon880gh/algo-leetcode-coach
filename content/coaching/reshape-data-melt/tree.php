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
            'message' => "Read the problem statement above.\nid_vars?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '[product]', 'next' => 's2'],
                ['label' => 'None', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. product is melted too; 10 rows instead of 8.\nStep back to when you left out id_vars.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "New column names?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The defaults', 'next' => 'wrong_b'],
                ['label' => 'var_name=quarter, value_name=sales', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They come out as variable and value.\nStep back to when you used defaults.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). 8 rows: Umbrella quarter_1 417, SleepingBag quarter_1 800, ….\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
