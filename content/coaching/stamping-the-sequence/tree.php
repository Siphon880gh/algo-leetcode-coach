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
            'message' => "Read the problem statement above.\nSimulate stamping forward?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: undo stamps from the last one back', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Going forward, you cannot tell which stamp must come first.\nStep back to when you went forward.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When does a window count as a match?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every letter equals the stamp', 'next' => 'wrong_b'],
                ['label' => 'Every letter is "?" or equals the stamp, and at least one is not "?"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Letters covered by later stamps are \"?\" and can be anything.\nStep back to when you required exact letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A full pass makes no change and letters remain. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return []', 'next' => 'success'],
                ['label' => 'Keep looping', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. No further progress is possible.\nStep back to when you kept looping.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² · m). stamp \"abc\", target \"ababc\" → [0,2]. stamp \"abca\", target \"aabcaca\" → [3,0,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
