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
            'message' => "Read the problem statement above.\nInner letter starts before the interval?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invalid interval', 'next' => 's2'],
                ['label' => 'Extend left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That interval belongs to the earlier letter.\nStep back to when you extended left.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Selection order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Longest first', 'next' => 'wrong_b'],
                ['label' => 'Earliest end first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Short, early intervals maximise the count.\nStep back to when you took the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Must every character be covered?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: leftovers are fine', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The substrings need not cover the string.\nStep back to when you forced full coverage.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26n). \"adefaddaccc\" → [\"e\",\"f\",\"ccc\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
