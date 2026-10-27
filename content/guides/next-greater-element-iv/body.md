## Wait once, then wait again

1. `ans` all −1; stacks `s1` and `s2` of indices.
2. For each `i` with value `x`: while the top of `s2` has a value `< x`, pop it and set its answer to `x`.
3. Pop every index with value `< x` from `s1`, and push them onto `s2` in their original order.
4. Push `i` onto `s1`. Return `ans`.

Examples → [9,6,6,−1,−1], [−1,−1]. Checked against scanning to the right for every index on 300 random arrays.

Settle `s2` before moving entries over, so one value cannot be both the first and the second greater for the same index. Keeping the moved block’s order keeps `s2` sorted. A sorted set or a heap also works in O(n log n).

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
