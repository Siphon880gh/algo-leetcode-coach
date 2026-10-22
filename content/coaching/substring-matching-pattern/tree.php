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
            'message' => "Read the problem statement above.\nWhich prefix match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The first one', 'next' => 's2'],
                ['label' => 'The last one', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. s = aba, p = a*b → false instead of true.\nStep back to when you took the last.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where may the suffix be?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anywhere', 'next' => 'wrong_b'],
                ['label' => 'At or after the prefix end', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s = ba, p = a*b → true instead of false.\nStep back to when you searched anywhere.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|s| · |p|). Examples → true, false, true.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
