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
            'message' => "Read the problem statement above.\nSort tables?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Numerically', 'next' => 's2'],
                ['label' => 'As strings', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. '10' would come before '3'.\nStep back to when you sorted strings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Customer names?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One column each', 'next' => 'wrong_b'],
                ['label' => 'Ignored', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only counts per food matter.\nStep back to when you added names.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Missing food at a table?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '"0"', 'next' => 'success'],
                ['label' => 'Omit the cell', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Every row needs every column.\nStep back to when you omitted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(N log N). Header sorted foods; e.g. table \"3\" with 2 Ceviche and 1 Fried Chicken.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
