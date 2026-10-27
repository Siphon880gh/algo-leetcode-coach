## Two patterns

1. If n = 1, return [0, 0]. mn = min, mx = max.
2. For k in {0, 1}: element i is wrong when (nums[i] − i) mod 2 ≠ k. Count them; move a wrong mn up and a wrong mx down. Range = max(1, new max − new min).
3. Return the smaller [ops, range] pair.

Examples → [2, 6], [1, 3], [0, 0]. Checked against trying every ±1 choice on 2,500 random arrays.

Always moving wrong elements up: constructed check (run in code) [1, 1, 0] → [1, 2] instead of [1, 1].

Use x & 1 for parity in languages where −3 % 2 is −1.

Time: O(n)  
Space: O(1)

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
