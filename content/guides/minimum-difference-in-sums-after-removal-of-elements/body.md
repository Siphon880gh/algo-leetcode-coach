## Best on each side of a split

1. Left to right with a max-heap of size `n`: `pre[i]` = sum of the `n` smallest in the first `i` values, for `i = n … 2n`.
2. Right to left with a min-heap of size `n`: `suf[i]` = sum of the `n` largest from index `i`, for `i = 2n … n`.
3. Return `min(pre[i] − suf[i])` over `i = n … 2n`.

Examples → −1, 1. Checked against removing every subset of size n on 200 small arrays.

The kept elements keep their order, so some index splits the first n kept from the last n. On each side the best choice is independent: smallest sum on the left, largest on the right.

Time: O(n log n)  
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
