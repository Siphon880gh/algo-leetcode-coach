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
            'message' => "Read the problem statement above.\nDouble the count for each letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: repeated letters create duplicates', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For \"aa\", doubling counts \"a\" twice.\nStep back to when you doubled.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reading c, set end[c] to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'end[c] + sum(end) + 1', 'next' => 'wrong_b'],
                ['label' => 'sum(end) + 1', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The old subsequences ending in c are all rebuilt by the new c; adding them counts them twice.\nStep back to when you added the old value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Include the empty subsequence in the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only non-empty subsequences count.\nStep back to when you added it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"abc\" → 7. \"aba\" → 6. \"aaa\" → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
