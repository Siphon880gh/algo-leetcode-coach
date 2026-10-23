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
            'message' => "Read the problem statement above.\nRemove which vowels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the trailing run', 'next' => 's2'],
                ['label' => 'Every vowel', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"d\" instead of \"id\".\nStep back to when you removed them all.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which end?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The start', 'next' => 'wrong_b'],
                ['label' => 'The end', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"dea\" instead of \"id\".\nStep back to when you stripped the front.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"id\", \"day\", \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
