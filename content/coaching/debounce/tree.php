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
            'message' => "Read the problem statement above.\nOn each call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Clear the pending timer, then start a new one', 'next' => 's2'],
                ['label' => 'Start a new timer and leave the old one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The old timer still fires; Example 1 → fn runs at 100 with [1] and at 125 with [2] instead of only at 125.\nStep back to when you kept the old timer.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Arguments passed to fn?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first call’s arguments in the burst', 'next' => 'wrong_b'],
                ['label' => 'The latest call’s arguments', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Only the last call counts; Example 1 → inputs [1] at 125 instead of [2].\nStep back to when you kept the first arguments.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Examples → [{t: 125, inputs: [2]}], two runs at 70 and 120, two runs at 200 and 450.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
