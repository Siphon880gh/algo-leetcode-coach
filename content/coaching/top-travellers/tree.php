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
            'message' => "Read the problem statement above.\nUsers with no rides?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Show 0 via COALESCE', 'next' => 's2'],
                ['label' => 'Omit them', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every user must appear.\nStep back to when you omitted them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Name only', 'next' => 'wrong_b'],
                ['label' => 'User id and name', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Names can repeat.\nStep back to when you grouped by name.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Tie on distance?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Name ascending', 'next' => 'success'],
                ['label' => 'Id ascending', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement breaks ties by name.\nStep back to when you used id.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Elvis and Lee → 450 (by name). Donald → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
