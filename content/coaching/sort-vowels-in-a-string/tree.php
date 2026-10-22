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
            'message' => "Read the problem statement above.\nWhich letters are vowels?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a, e, i, o, u in both cases', 'next' => 's2'],
                ['label' => 'Lowercase a, e, i, o, u only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Uppercase vowels count; example 1 → lEetcOde instead of lEOtcede.\nStep back to when you skipped uppercase.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort the vowels by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letter, ignoring case', 'next' => 'wrong_b'],
                ['label' => 'ASCII value', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Uppercase comes first in ASCII; example 1 → lEetcedO instead of lEOtcede.\nStep back to when you ignored case.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → lEOtcede, lYmpH.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
