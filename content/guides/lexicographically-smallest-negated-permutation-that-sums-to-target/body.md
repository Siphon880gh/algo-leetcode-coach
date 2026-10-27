## Greedy set

1. S = n(n + 1)/2. If |target| > S or S − target is odd, return [].
2. D = (S − target)/2. For x = n … 1: if x ≤ D, negate x and D −= x.
3. Return the negatives in decreasing magnitude, then the rest in increasing order.

Examples → [−3, 1, 2], []. Checked against trying every signed permutation for n ≤ 5 and every reachable target.

Negating the smallest numbers first: example 1 → [−2, −1, 3] instead of [−3, 1, 2].

Time: O(n)  
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
