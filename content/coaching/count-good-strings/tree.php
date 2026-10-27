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
            'message' => "Read the problem statement above.\n\"aaab\" = \"aaa\" + \"b\". Where can a split between s1 and s2 fall?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Anywhere', 'next' => 'wrong_a'],
                ['label' => 'Only where the letter changes, between runs', 'next' => 's2'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The last letter of s1 must differ from the first letter of s2, so a split cannot cut a run. That is why \"aa\" is not good: its only run has even length.\nStep back to when you split inside a run.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "n can be 10^15. How do you get F(n)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Loop n times', 'next' => 'wrong_b'],
                ['label' => 'Fast doubling in O(log n)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 10^15 iterations will not finish.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. 2 · F(n) mod 10^9 + 7 by fast doubling. O(log n). Examples give 6, 4 and 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
