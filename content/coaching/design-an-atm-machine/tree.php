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
            'message' => "Read the problem statement above.\nChange counts while planning?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: commit only if the plan succeeds', 'next' => 's2'],
                ['label' => 'Yes, subtract as you go', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1’s rejected 600 would still take the 500, breaking the final 550.\nStep back to when you subtracted early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greedy fails?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Retry with smaller notes', 'next' => 'wrong_b'],
                ['label' => 'Reject', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The machine must use larger notes first and may not swap in 200s for the 500.\nStep back to when you retried.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How many of a note?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(count, amount / d) at once', 'next' => 'success'],
                ['label' => 'One note at a time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts reach 10^9, so single steps are far too slow.\nStep back to when you took one note at a time.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. Example 1 matches.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
