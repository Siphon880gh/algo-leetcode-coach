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
            'message' => "Read the problem statement above.\nFirst try?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'target’s first half mirrored, if it uses exactly the half letters', 'next' => 's2'],
                ['label' => 'Skip it and raise a letter at once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): s = \"b\", target = \"a\" → \"\" instead of \"b\".\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Raised letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest remaining letter ≥ target[i]', 'next' => 'wrong_b'],
                ['label' => 'Smallest remaining letter > target[i]', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"abba\", which is not greater than target.\nStep back to when you allowed equal.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → \"baab\", \"\", \"\", \"aca\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
