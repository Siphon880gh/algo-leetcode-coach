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
            'message' => "Read the problem statement above.\nMatches of a?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every start', 'next' => 's2'],
                ['label' => 'The first start (find)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → [16] instead of [16, 33].\nStep back to when you used find.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Nearby b?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only starts at or after i', 'next' => 'wrong_b'],
                ['label' => 'Any start within k on either side', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1’s 33 has squirrel at 18, before it; → [16].\nStep back to when you looked only ahead.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → [16, 33], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
