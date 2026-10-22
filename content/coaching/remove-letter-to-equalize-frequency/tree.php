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
            'message' => "Read the problem statement above.\nMay you skip the removal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, exactly one letter goes', 'next' => 's2'],
                ['label' => 'Yes, if the counts already match', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → true instead of false.\nStep back to when you skipped the removal.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare counts of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 26 letters', 'next' => 'wrong_b'],
                ['label' => 'Letters still present', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Absent letters have count 0; Example 1 → false instead of true.\nStep back to when you included absent letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Decide how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every removal', 'next' => 'success'],
                ['label' => 'Accept when there are at most two distinct counts', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2 has counts 2 and 2 → true instead of false.\nStep back to when you used the shortcut.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 26). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
