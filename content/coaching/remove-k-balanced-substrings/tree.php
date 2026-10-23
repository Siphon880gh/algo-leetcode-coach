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
            'message' => "Read the problem statement above.\nSeveral rounds of removal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A stack handles them in one pass', 'next' => 's2'],
                ['label' => 'One round is enough', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"()\" instead of \"\".\nStep back to when you stopped after one round.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cancel when the run below has?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly k "("', 'next' => 'wrong_b'],
                ['label' => 'At least k "("', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → \"(())\" instead of \"\".\nStep back to when you required exactly k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"\", \"((\", \"()()()\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
