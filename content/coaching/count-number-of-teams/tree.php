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
            'message' => "Read the problem statement above.\nEnumerate triples?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: fix the middle', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n³).\nStep back to when you enumerated triples.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Increasing teams through j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'lessLeft · lessRight', 'next' => 'wrong_b'],
                ['label' => 'lessLeft · greaterRight', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The right soldier must be larger.\nStep back to when you used lessRight.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Also count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Decreasing teams', 'next' => 'success'],
                ['label' => 'Only increasing ones', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Both directions are valid teams.\nStep back to when you skipped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). [2,5,3,4,1] → 3. [2,1,3] → 0. [1,2,3,4] → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
