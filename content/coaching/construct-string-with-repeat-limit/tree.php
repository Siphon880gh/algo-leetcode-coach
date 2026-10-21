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
            'message' => "Read the problem statement above.\nWhich letter first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest one left', 'next' => 's2'],
                ['label' => 'Letters in their original order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 must start with zz.\nStep back to when you kept the original order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Run hits repeatLimit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Write as many of it as allowed', 'next' => 'wrong_b'],
                ['label' => 'Write one copy of the next smaller letter', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → bbaabaa, but bbabaa is larger.\nStep back to when you wrote several.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No smaller letter left?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Stop', 'next' => 'success'],
                ['label' => 'Keep writing the same letter', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That breaks the repeat limit; unused letters are allowed.\nStep back to when you kept writing.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 26). Examples → zzcccac, bbabaa.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
