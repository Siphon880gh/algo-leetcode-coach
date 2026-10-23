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
            'message' => "Read the problem statement above.\nWord value?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sum of weights[letter]', 'next' => 's2'],
                ['label' => 'Sum of letter positions', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → \"zyx\" instead of \"yyy\".\nStep back to when you skipped the weights.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Map r to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '‘a’ + r', 'next' => 'wrong_b'],
                ['label' => '‘z’ − r', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → \"bbb\" instead of \"yyy\".\nStep back to when you mapped forward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total letters). Examples → \"rij\", \"yyy\", \"g\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
