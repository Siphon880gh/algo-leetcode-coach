## Generate subset sums in order

1. `top = Σ max(x, 0)`; `a` = sorted `|x|`.
2. Heap starts with `(a[0], 0)`. Pop k − 1 times; after popping `(s, i)`, push `(s + a[i + 1], i + 1)` and `(s − a[i] + a[i + 1], i + 1)`.
3. Return `top − last popped`, or `top` when k = 1.

Examples → 2, 10. Checked against listing every subsequence sum on 300 random arrays.

Dropping a positive or adding a negative both lower the sum by |x|, so the question becomes the (k − 1)-th smallest non-empty subset sum of a. The two pushes generate each subset once in non-decreasing order. Sums reach 10^14, so use 64-bit.

Time: O(n log n + k log k)  
Space: O(n + k)

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
