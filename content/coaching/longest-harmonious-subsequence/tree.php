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
            'message' => "Read the problem statement above.\nLook for a contiguous window?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: it is a subsequence, so only the counts matter', 'next' => 's2'],
                ['label' => 'Yes: slide a window over nums', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A subsequence can skip elements; [1,3,2,2,5,2,3,7] → 5 uses values scattered through the array.\nStep back to when you used a window.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which values can a harmonious subsequence use?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One value repeated', 'next' => 'wrong_b'],
                ['label' => 'Exactly two: x and x + 1, taking every copy of both', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. max − min must be exactly 1, and a single value gives 0.\nStep back to when you used one value.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you compute the answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[x] + cnt[x + 1] for each x with x + 1 present', 'next' => 'success'],
                ['label' => 'cnt[x − 1] + cnt[x] + cnt[x + 1]', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. x − 1 and x + 1 differ by 2, which breaks the rule.\nStep back to when you used three values.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Counts, then the best adjacent pair: O(n) time and space. [1,3,2,2,5,2,3,7] → 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
