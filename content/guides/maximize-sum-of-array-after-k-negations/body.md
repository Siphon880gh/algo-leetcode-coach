## Spend flips where they gain most

1. Sort `nums`.
2. For `i` in order while `k > 0` and `nums[i] < 0`: `nums[i] = −nums[i]`, `k −= 1`.
3. If `k` is odd, subtract `2 · min(abs values)` from the sum (flip the smallest one). An even leftover cancels out on any element.

Return the sum.

The smallest absolute value is found after step 2, since flipped numbers changed sign.

With values in [−100, 100], a counting array avoids sorting.

Do not flip the same smallest element k times one by one; parity is all that matters. Do not ignore zeros; a 0 absorbs any leftover flips for free.

Time: O(n log n)  
Space: O(1) besides the sort

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
