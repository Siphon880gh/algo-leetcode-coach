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
            'message' => "Read the problem statement above.\nFirst check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return "" when sum > 9 · num', 'next' => 's2'],
                ['label' => 'Start filling right away', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → \"9\" instead of \"\" (the leftover sum is lost).\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where do the big digits go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the back', 'next' => 'wrong_b'],
                ['label' => 'At the front', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → \"89\" instead of \"98\" (same score, smaller number).\nStep back to when you put them last.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(num). Examples → \"30\", \"98\", \"\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
