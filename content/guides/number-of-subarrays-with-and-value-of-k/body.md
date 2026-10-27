## Counted AND set

1. cur: map from AND value to how many subarrays ending at i have it.
2. Next: AND each key with x (merging counts), add x with count 1, then add cur[k] to the answer.

Examples → 6, 3, 2. Checked against every subarray on 300 random arrays.

The answer reaches n(n + 1)/2 ≈ 5 · 10^9; use 64-bit. Every subarray directly is that many steps.

Time: O(31 n)  
Space: O(31)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
