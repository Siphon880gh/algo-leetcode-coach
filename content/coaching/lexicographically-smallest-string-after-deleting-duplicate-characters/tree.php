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
            'message' => "Read the problem statement above.\nPop a larger top when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Another copy is still ahead or already in the stack', 'next' => 's2'],
                ['label' => 'Only when another copy is still ahead, keeping each letter once', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → \"acb\" instead of \"aacb\".\nStep back to when you kept each letter once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the scan?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the stack as is', 'next' => 'wrong_b'],
                ['label' => 'Pop the top while the stack holds another copy of it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): \"abb\" → \"abb\" instead of \"ab\".\nStep back to when you skipped the final trim.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → \"aacb\", \"z\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
