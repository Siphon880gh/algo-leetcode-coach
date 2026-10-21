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
            'message' => "Read the problem statement above.\nStrip the day suffix?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the last two characters', 'next' => 's2'],
                ['label' => 'Keep the first digit only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Days can have two digits.\nStep back to when you kept one digit.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Month lookup?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Parse as a number', 'next' => 'wrong_b'],
                ['label' => 'Index in [Jan … Dec] + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Months are names.\nStep back to when you parsed digits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Padding?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two digits for month and day', 'next' => 'success'],
                ['label' => 'None', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 6th Jun 1933 must become 1933-06-06.\nStep back to when you skipped padding.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). \"20th Oct 2052\" → \"2052-10-20\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
