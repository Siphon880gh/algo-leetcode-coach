## States

1. If |k| > 12 · n, return −1.
2. For each x: start a new state (x, next −, x); extend each state by adding or subtracting x, product min(p · x, limit + 1).
3. Answer the largest p ≤ limit among states with sum k, or −1.

Examples → 6, −1, 9. Checked against every subsequence on 400 random arrays.

Dropping states whose product passes limit: [3, 4, 0], k = −1, limit = 5 → −1 instead of 0.

Time: O(n · sums · products)  
Space: the same

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
