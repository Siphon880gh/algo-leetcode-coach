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
            'message' => "Read the problem statement above.\nMissing number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Push then Pop', 'next' => 's2'],
                ['label' => 'Skip it', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The stream must be read in order.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the last target?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Read until n', 'next' => 'wrong_b'],
                ['label' => 'Stop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Extra operations are not needed.\nStep back to when you read to n.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Target sorted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes, strictly increasing', 'next' => 'success'],
                ['label' => 'Must sort it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement guarantees order.\nStep back to when you sorted.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. [1,3], n = 3 → Push, Push, Pop, Push. [1,2], n = 4 → Push, Push.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
