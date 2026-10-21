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
            'message' => "Read the problem statement above.\nCharacters to try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only those appearing at least k times', 'next' => 's2'],
                ['label' => 'Every character of s', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A character with fewer than k copies cannot appear in seq repeated k times, and keeping it blows up the search.\nStep back to when you used every character.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Why does growing by length lose nothing?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid seqs are always sorted', 'next' => 'wrong_b'],
                ['label' => 'Every prefix of a valid seq is valid too', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. let is valid and not sorted; the prefix property is the reason.\nStep back to when you assumed sorted order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Several of the longest length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the lexicographically largest', 'next' => 'success'],
                ['label' => 'Return the smallest', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 picks let over ete.\nStep back to when you took the smallest.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → let, b, empty.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
