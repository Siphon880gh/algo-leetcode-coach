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
            'message' => "Read the problem statement above.\nWhich plate characters count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letters only, lowercased', 'next' => 's2'],
                ['label' => 'Every character', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Digits and spaces are ignored, and case does not matter.\nStep back to when you counted every character.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Is containing each letter enough?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: repeated letters need repeated copies', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. \"1s3 PSt\" needs two s letters.\nStep back to when you checked letter sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Two completing words have the same length. Which wins?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one that comes first', 'next' => 'success'],
                ['label' => 'The alphabetically smaller', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The problem picks the first occurrence in the list.\nStep back to when you compared alphabetically.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). \"1s3 PSt\", [\"step\",\"steps\",\"stripe\",\"stepple\"] → \"steps\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
