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
            'message' => "Read the problem statement above.\nPer end index add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(last) + 1', 'next' => 's2'],
                ['label' => 'max(last) + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Every start up to the smallest last position works.\nStep back to when you took the max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A letter not seen yet?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Skip the index', 'next' => 'wrong_b'],
                ['label' => 'Its last is −1, adding 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The −1 sentinel already adds 0.\nStep back to when you special-cased it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Enumerate all substrings?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: O(n)', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n²).\nStep back to when you enumerated them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abcabc\" → 10. \"aaacb\" → 3. \"abc\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
