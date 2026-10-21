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
            'message' => "Read the problem statement above.\nBranch on tile positions and deduplicate with a set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: branch on distinct letters', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Equal tiles would repeat work.\nStep back to when you branched on positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After choosing letter c, what do you add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dfs() only', 'next' => 'wrong_b'],
                ['label' => '1 + dfs() with c used', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sequence ending with c counts too.\nStep back to when you added only dfs().",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After the recursive call?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Restore cnt[c]', 'next' => 'success'],
                ['label' => 'Leave it decremented', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Other branches need that tile.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(sequences · 26). \"AAB\" → 8. \"AAABBC\" → 188. \"V\" → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
