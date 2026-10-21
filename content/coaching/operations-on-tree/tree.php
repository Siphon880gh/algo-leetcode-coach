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
            'message' => "Read the problem statement above.\nUnlock by a different user?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fail', 'next' => 's2'],
                ['label' => 'Succeed', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Only the user who locked the node may unlock it.\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Upgrade conditions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unlocked and no locked ancestor', 'next' => 'wrong_b'],
                ['label' => 'Unlocked, a locked descendant, no locked ancestor', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Upgrade also needs at least one locked descendant.\nStep back to when you skipped that check.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which descendants does upgrade unlock?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All of them, whoever locked them', 'next' => 'success'],
                ['label' => 'Only those locked by the same user', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Upgrade unlocks descendants regardless of the user.\nStep back to when you filtered by user.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Upgrade O(n). Example → true, false, true, true, true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
