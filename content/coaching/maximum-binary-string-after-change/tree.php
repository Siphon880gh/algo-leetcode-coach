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
            'message' => "Read the problem statement above.\nNo zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the string unchanged', 'next' => 's2'],
                ['label' => 'Flip something', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. All ones is already maximal.\nStep back to when you flipped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many zeros survive?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'wrong_b'],
                ['label' => 'Exactly one', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 00 → 10 always leaves one zero behind.\nStep back to when you removed all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Where does it land?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'firstZero + zeros − 1', 'next' => 'success'],
                ['label' => 'The last index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The zeros gather right after the leading ones, so the survivor sits at firstZero + zeros − 1.\nStep back to when you used the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"000110\" → \"111011\". \"01\" → \"01\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
