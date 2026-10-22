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
            'message' => "Read the problem statement above.\nLength from z zeros followed by o ones?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · min(z, o)', 'next' => 's2'],
                ['label' => 'z + o', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The counts must be equal; Example 2 → 5 instead of 4.\nStep back to when you added the runs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which runs pair up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All zeros with all ones in the string', 'next' => 'wrong_b'],
                ['label' => 'A 0-run with the 1-run right after it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The substring must be contiguous; Example 1 → 8 instead of 6.\nStep back to when you counted the whole string.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 4, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
