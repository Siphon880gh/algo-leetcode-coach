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
            'message' => "Read the problem statement above.\nNumber of rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Length of the longest word', 'next' => 's2'],
                ['label' => 'Number of words', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rows are character positions.\nStep back to when you used the word count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A word is too short?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip it', 'next' => 'wrong_b'],
                ['label' => 'Use a space', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Later letters would shift columns.\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Trim what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Trailing spaces only', 'next' => 'success'],
                ['label' => 'Both ends', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading spaces keep letters aligned.\nStep back to when you trimmed both ends.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(words · L). \"HOW ARE YOU\" → [\"HAY\",\"ORO\",\"WEU\"]. \"TO BE OR NOT TO BE\" → [\"TBONTB\",\"OEROOE\",\"   T\"].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
