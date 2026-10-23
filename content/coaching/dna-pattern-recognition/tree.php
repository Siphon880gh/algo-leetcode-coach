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
            'message' => "Read the problem statement above.\nhas_start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LIKE \'ATG%\'', 'next' => 's2'],
                ['label' => 'LIKE \'%ATG%\'', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Sample 7 gets has_start = 1 instead of 0.\nStep back to when you dropped the anchor.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "has_stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Contains one of them', 'next' => 'wrong_b'],
                ['label' => 'Ends with TAA, TAG or TGA', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Sample 3 gets has_stop = 1 instead of 0.\nStep back to when you searched anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Example → the official flags.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
