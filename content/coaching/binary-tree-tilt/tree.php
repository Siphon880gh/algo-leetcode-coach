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
            'message' => "Read the problem statement above.\nA tilt needs subtree sums. How do you get them?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One post-order pass that returns each subtree sum', 'next' => 's2'],
                ['label' => 'Call a separate sum() at every node', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Re-summing below every node is O(n²) on a skewed tree.\nStep back to when you re-summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At a node with left sum L and right sum R, what do you do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return |L − R| to the parent', 'next' => 'wrong_b'],
                ['label' => 'Add |L − R| to the total, return L + R + node.val', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The parent needs this subtree's sum, not its tilt; tilts go into a separate total.\nStep back to when you returned the tilt.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "One child is missing. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It sums to 0, and the tilt is still |L − R|', 'next' => 'success'],
                ['label' => 'Skip the tilt at that node', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A missing subtree sums to 0; the node still has tilt |L − 0|.\nStep back to when you skipped the node.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Post-order sums with |L − R| added along the way: O(n) time, O(h) space. [1,2,3] → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
