## Sorted positions

1. pos[v] = sorted indices of v.
2. For query q: if pos[nums[q]] has one index, −1. Otherwise take the entries before and after q (cyclically) and return the smaller min(|i − q|, n − |i − q|).

Examples → [2, −1, 3], [−1, −1, −1, −1]. Checked against scanning every index on 500 random arrays.

Using plain |i − q|: example 1 → [2, −1, 4] instead of [2, −1, 3].

Time: O(n + q log n)  
Space: O(n)

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
